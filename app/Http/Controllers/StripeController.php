<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use App\Models\Item;
use Stripe\Checkout\Session as StripeCheckoutSession;

class StripeController extends Controller
{
    public function createSession(Request $request, $itemId)
    {
        $item = Item::findOrFail($itemId);
        // dd($item->price); // 価格を確認

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $checkout_session = StripeCheckoutSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => $item->price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('user.success'),
            'cancel_url' => route('user.cancel'),
        ]);
        // dd($checkout_session);

        return response()->json(['id' => $checkout_session->id]);
    }

    public function success()
    {
        return view('item.show');
    }

    public function cancel()
    {
        return view('payment.checkout');
    }


}
