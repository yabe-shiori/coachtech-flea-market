<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ItemStoreRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\LoginBonusHistory;

class ItemController extends Controller
{
    // 商品一覧ページ
    public function index()
    {
        $itemImages = Item::with('images')->get();

        $alreadyReceivedToday = false;
        if (Auth::check()) {
            $user = Auth::user();
            $alreadyReceivedToday = LoginBonusHistory::where('user_id', $user->id)
                ->whereDate('date_awarded', today())
                ->exists();
        }

        return view('item.index', compact('itemImages', 'alreadyReceivedToday'));
    }

    // 商品詳細ページ
    public function show(Item $item)
    {
        return view('item.show', compact('item'));
    }

    // 出品ページ表示
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('user.item.index')->with('error', 'ログインしてください。');
        }

        $categories = Category::all();
        $brands = Brand::all();

        return view('item.create', compact('categories', 'brands'));
    }

    // 出品
    public function store(ItemStoreRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            $user = Auth::user();
            $item = $user->items()->create([
                'name' => $data['name'],
                'price' => $data['price'],
                'condition' => $data['condition'],
                'description' => $data['description']
            ]);

            $selectedCategories = (array) $request->input('category_id');
            $parentCategories = Category::whereIn('id', $selectedCategories)->pluck('parent_id')->toArray();
            $allCategories = array_merge($selectedCategories, $parentCategories);
            $item->category()->sync($allCategories);

            if ($request->filled('brand_id')) {
                $item->brand()->associate($request->input('brand_id'));
                $item->save();
            }

            foreach ($request->file('image') as $image) {
                $item->images()->create([
                    'image_path' => $image->store('item_images', 'public')
                ]);
            }

            DB::commit();

            return redirect()->route('user.item.index')->with('message', '商品を出品しました。');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', '出品中にエラーが発生しました。もう一度お試しください。');
        }
    }

    // 商品検索
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
        })->orderBy('price')->get();

        return view('item.search', compact('items'));
    }
}
