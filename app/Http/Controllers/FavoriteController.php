<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Item;


class FavoriteController extends Controller
{

    //マイリスト表示
    public function index()
    {
        $itemImages = Item::with('images')->get();
        return view('mylist', compact('itemImages'));
    }


    // お気に入り登録
    public function store(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('user.login');
        }

        //既にお気に入りに追加されているか確認
        if (!$user->isFavorite($request->item_id)) {

            $favorite = new Favorite();
            $favorite->user_id = $user->id;
            $favorite->item_id = $request->item_id;
            $favorite->save();
        }

        return redirect()->back();
    }
    public function removeFavorite(Request $request)
    {
    }
}
