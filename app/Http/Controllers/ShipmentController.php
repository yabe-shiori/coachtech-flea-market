<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ShipmentController extends Controller
{
    //配送先変更ページ表示
    public function create(Request $request)
    {
        $user = auth()->user();

        return view('payment.shipping', compact('user'));
    }
}
