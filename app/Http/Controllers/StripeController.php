<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use App\Models\Item;
use App\Models\SoldItem;
use Stripe\Checkout\Session as StripeCheckoutSession;

class StripeController extends Controller
{

    //Stripeのセッションを作成
    public function createSession(Request $request, $itemId)
    {
        $item = Item::findOrFail($itemId);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $checkoutSession = StripeCheckoutSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => intval($item->price),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('user.success', ['item_id' => $itemId]),
            'cancel_url' => route('user.cancel', ['itemId' => $itemId]),
        ]);

        $request->session()->put('stripe_checkout_session_id', $checkoutSession->id);

        return response()->json(['id' => $checkoutSession->id]);
    }

    //決済成功時の処理
    public function success(Request $request)
    {
        $checkoutSessionId = $request->session()->pull('stripe_checkout_session_id');
        $itemId = $request->query('item_id');
        $item = Item::findOrFail($itemId);
        $user = auth()->user();

        $this->updateItemAndCreateSoldItem($item, $user);

        return view('payment.success', compact('user', 'item'));
    }

    //決済キャンセル時の処理
    public function cancel($itemId)
    {
        $item = Item::findOrFail($itemId);
        return view('payment.checkout', compact('item'));
    }

    //商品のis_soldをtrueに更新し、SoldItemを作成
    private function updateItemAndCreateSoldItem($item, $user)
    {
        $item->update(['is_sold' => true]);

        SoldItem::create([
            'item_id' => $item->id,
            'buyer_id' => $user->id,
            'seller_id' => $item->user_id,
            'sold_at' => now(),
        ]);
    }
}
