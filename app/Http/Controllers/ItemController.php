<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Brand;

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

    //出品ページ
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('item.create', compact('categories', 'brands'));
    }
    

    //出品
    public function store(Request $request)
    {

    }
}
