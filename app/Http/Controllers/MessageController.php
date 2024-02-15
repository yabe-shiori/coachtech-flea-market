<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class MessageController extends Controller
{
    public function show($itemId)
    {
        $item = Item::findOrFail($itemId);

        return view('item.message', compact('item'));
    }
}
