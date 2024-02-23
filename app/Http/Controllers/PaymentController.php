<?php

namespace App\Http\Controllers;


use App\Models\Item;
use Illuminate\Support\Facades\Auth;


class PaymentController extends Controller
{
    // 支払いページの表示
    public function create($itemId)
    {
        // ログインしているユーザーを取得
        $user = Auth::user();

        // ユーザーがログインしていない場合はログインページにリダイレクト
        if (!$user) {
            return redirect()->route('login')->with('error', 'ログインしてください。');
        }

        // 商品を取得
        $item = Item::findOrFail($itemId);

        // 商品が売り切れている場合はエラーメッセージを表示
        if ($item->is_sold) {
            return back()->with('error', '申し訳ありませんが、この商品は売り切れです。');
        }

        // ビューに必要なデータを渡して支払いページを表示
        return view('payment.checkout', compact('item', 'user'));
    }
}
