<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $itemImages = Item::with('images')->get();
        return view('user.index', compact('itemImages'));
    }

    //商品詳細ページ
    public function show(Item $item)
    {
        return view('item.show', compact('item'));
    }
}
