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
use Illuminate\Support\Facades\Storage;


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

    // 商品編集ページ表示
    public function edit(Item $item)
    {
        if (!Auth::check()) {
            return redirect()->route('user.item.index')->with('error', 'ログインしてください。');
        }

        if ($item->is_sold) {
            return redirect()->back()->with('error', '売り切れの商品は編集できません。');
        }

        $categories = Category::all();
        $brands = Brand::all();
        $conditions = ['新品、未使用', '未使用に近い', '目立った傷や汚れなし', 'やや傷や汚れあり', '傷や汚れあり', '全体的に状態が悪い'];

        return view('item.edit', compact('item', 'categories', 'brands', 'conditions'));
    }

    // 商品更新
    public function update(ItemStoreRequest $request, Item $item)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            $item->update([
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

            if ($request->hasFile('image')) {
                foreach ($item->images as $image) {
                    Storage::disk('public')->delete($image->image_path);
                    $image->delete();
                }

                foreach ($request->file('image') as $newImage) {
                    $item->images()->create([
                        'image_path' => $newImage->store('item_images', 'public')
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('user.item.index')->with('message', '商品を更新しました。');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', '商品の更新中にエラーが発生しました。もう一度お試しください。');
        }
    }
}
