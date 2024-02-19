<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use App\Models\Item;
use App\Models\SoldItem;
use Stripe\Checkout\Session as StripeCheckoutSession;

class StripeController extends Controller
{
    public function createSession(Request $request, $itemId)
    {
        $item = Item::findOrFail($itemId);
        $buyerId = auth()->id();
        $sellerId = $item->user_id;

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
            'success_url' => route('user.success'),
            'cancel_url' => route('user.cancel', ['itemId' => $itemId]),
        ]);

        $existingSoldItem = SoldItem::where('item_id', $item->id)
            ->where('buyer_id', $buyerId)
            ->where('seller_id', $sellerId)
            ->first();

        if (!$existingSoldItem) {
            SoldItem::create([
                'item_id' => $item->id,
                'buyer_id' => $buyerId,
                'seller_id' => $sellerId,
                'sold_at' => now(),
            ]);
        }

        $item->update(['is_sold' => true]);

        return response()->json(['id' => $checkoutSession->id]);
    }

    public function success()
    {
        return view('payment.success');
    }

    public function cancel($itemId)
    {
        $item = Item::findOrFail($itemId);
        return view('payment.checkout', compact('item'));
    }
}
