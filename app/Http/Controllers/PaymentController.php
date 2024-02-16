<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Payment;
use App\Models\Item;

class PaymentController extends Controller
{
    // 支払いページの表示
    public function create($itemId)
    {
        $item = Item::findOrFail($itemId);

        return view('payment.checkout', compact('item'));
    }

    

}
