<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Brand;
use App\Http\Requests\ItemStoreRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;



class ItemController extends Controller
{
    public function index()
    {
        $itemImages = Item::with('images')->get();
        return view('item.index', compact('itemImages'));
    }

    //商品詳細ページ
    public function show(Item $item)
    {
        return view('item.show', compact('item'));
    }

    //出品ページ
    public function create()
    {
        if (Auth::check()) {
            $categories = Category::all();
            $brands = Brand::all();
            return view('item.create', compact('categories', 'brands'));
        } else {
            return redirect()->route('user.item.index')->with('message', '出品するにはログインしてください。');
        }
    }

    // 出品
    public function store(ItemStoreRequest $request)
    {
        $data = $request->validated();

        $user = Auth::user();
        $item = new Item();
        $item->user_id = $user->id;
        $item->name = $data['name'];
        $item->price = $data['price'];
        $item->condition = $data['condition'];
        $item->description = $data['description'];
        $item->save();

        $selectedCategories = (array) $request->input('category_id');
        $parentCategories = Category::whereIn('id', $selectedCategories)->pluck('parent_id')->toArray();
        $allCategories = array_merge($selectedCategories, $parentCategories);

        $item->category()->sync($allCategories);

        foreach ($request->file('image') as $image) {
            $item->images()->create([
                'image_path' => $image->store('item_images', 'public')
            ]);
        }

        return redirect()->route('user.item.index')->with('message', '商品を出品しました。');
    }

    //商品検索
    public function search(Request $request)
    {
        $searchQuery = $request->input('query');

        $items = Item::where(function ($query) use ($searchQuery) {
            $query->searchByName($searchQuery)
                ->orWhere(function ($query) use ($searchQuery) {
                    $query->searchByCategory($searchQuery);
                })
                ->orWhere(function ($query) use ($searchQuery) {
                    $query->searchByBrand($searchQuery);
                });
        })
            ->get();

        return view('item.search', compact('items'));
    }
}
