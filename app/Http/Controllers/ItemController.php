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
}
