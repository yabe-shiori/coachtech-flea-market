<?php

namespace App\Http\Controllers;


use App\Models\Item;
use Illuminate\Support\Facades\Auth;


class PaymentController extends Controller
{
    // 支払いページの表示
    public function create($itemId)
    {
        if (!Auth::check()) {
            return back()->with('error', 'ログインしてください。');
        }

        $item = Item::findOrFail($itemId);

        if ($item->is_sold) {
            return back()->with('error', '申し訳ありませんが、この商品は売り切れです。');
        }

        return view('payment.checkout', compact('item'));
    }

}
