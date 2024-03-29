<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use App\Models\Item;
use App\Models\SoldItem;
use Stripe\Checkout\Session as StripeCheckoutSession;
use App\Notifications\ItemSoldNotification;

class StripeController extends Controller
{
    // Stripeのセッションを作成
    public function createSession(Request $request, $itemId)
    {
        $item = Item::findOrFail($itemId);

        if ($item->is_sold) {
            return redirect()->route('user.item.show', ['item' => $itemId])->with('message', '売り切れです');
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        DB::beginTransaction();

        try {
            $paymentMethod = $request->input('payment_method');
            $paymentMethodTypes = $this->getPaymentMethodTypes($paymentMethod);

            $user = auth()->user();
            $selectedPoints = $request->input('points_to_use', 0);
            $pointValue = $selectedPoints * 1;

            $request->session()->put('selected_points', $pointValue);

            $user->points()->decrement('balance', $pointValue);

            $itemPrice = $item->price - $pointValue;

            $lineItems = $this->getLineItems($item, $itemPrice);

            $checkoutSession = StripeCheckoutSession::create([
                'payment_method_types' => $paymentMethodTypes,
                'payment_method_options' => $this->getPaymentMethodOptions($paymentMethod),
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('user.success', ['item_id' => $itemId]),
                'cancel_url' => route('user.cancel', ['itemId' => $itemId]),
            ]);

            $request->session()->put('stripe_checkout_session_id', $checkoutSession->id);
            DB::commit();

            return response()->json(['id' => $checkoutSession->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('user.item.show', ['item' => $itemId])->with('error', '決済セッションの作成中にエラーが発生しました。');
        }
    }

    // 決済成功時の処理
    public function success(Request $request)
    {
        $checkoutSessionId = $request->session()->pull('stripe_checkout_session_id');
        $itemId = $request->query('item_id');
        $item = Item::findOrFail($itemId);
        $user = auth()->user();

        DB::beginTransaction();

        try {
            $this->updateItemAndCreateSoldItem($item, $user);
            DB::commit();
            return view('payment.success', compact('user', 'item'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('user.item.show', ['item' => $itemId])->with('error', '決済処理中にエラーが発生しました。');
        }
    }

    // 決済キャンセル時の処理
    public function cancel(Request $request, $itemId)
    {
        $item = Item::findOrFail($itemId);
        $user = auth()->user();

        DB::beginTransaction();

        try {
            $selectedPoints = $request->session()->pull('selected_points', 0);

            if ($selectedPoints > 0) {
                $user->points()->increment('balance', $selectedPoints);
            }

            DB::commit();

            return view('payment.checkout', compact('item'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('user.item.show', ['item' => $itemId])
                ->with('error', 'キャンセル処理中にエラーが発生しました。');
        }
    }

    private function updateItemAndCreateSoldItem($item, $user)
    {
        $item->update(['is_sold' => true]);

        $item->user->notify(new ItemSoldNotification($item));


        $pointsEarned = $item->price * 0.01;

        $points = $user->points()->firstOrCreate(
            ['user_id' => $user->id],
            ['balance' => 0]
        );

        $points->increment('balance', $pointsEarned);

        SoldItem::create([
            'item_id' => $item->id,
            'buyer_id' => $user->id,
            'seller_id' => $item->user_id,
            'sold_at' => now(),
        ]);
    }

    private function getPaymentMethodTypes($paymentMethod)
    {
        return $paymentMethod === 'konbini' ? ['konbini'] : ['card'];
    }

    private function getPaymentMethodOptions($paymentMethod)
    {
        if ($paymentMethod === 'konbini') {
            return [
                'konbini' => [
                    'expires_after_days' => 7,
                ],
            ];
        }
        return [];
    }


    private function getLineItems($item, $itemPrice)
    {
        return [[
            'price_data' => [
                'currency' => 'jpy',
                'product_data' => [
                    'name' => $item->name,
                ],
                'unit_amount' => intval($itemPrice),
            ],
            'quantity' => 1,
        ]];
    }
}
