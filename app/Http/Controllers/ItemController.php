<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Brand;
use App\Http\Requests\ItemStoreRequest;
use Illuminate\Support\Facades\Auth;

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
    public function store(ItemStoreRequest $request)
    {
        $data = $request->validated();

        $user = Auth::user();
        $item = new Item();
        $item->user_id = $user->id;
        $item->name = $data['name'];
        $item->category_id = $data['category_id'];
        $item->brand_id = $data['brand_id'];
        $item->price = $data['price'];
        $item->condition = $data['condition'];
        $item->description = $data['description'];
        $item->save();

        foreach ($data['images'] as $image) {
            $item->images()->create([
                'image_path' => $image->store('item_images', 'public')
            ]);
        }

        return redirect()->route('items.index')->with('message', '商品を出品しました。');
    }
    }

