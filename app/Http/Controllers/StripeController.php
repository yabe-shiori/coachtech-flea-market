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

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $checkout_session = StripeCheckoutSession::create([
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

        $buyer_id = auth()->id();
        $seller_id = $item->user_id;
        SoldItem::create([
            'item_id' => $item->id,
            'buyer_id' => $buyer_id,
            'seller_id' => $seller_id,
            'sold_at' => now(),
        ]);

        $item->update(['is_sold' => true]);

        return response()->json(['id' => $checkout_session->id]);
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
