<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;


class FavoriteController extends Controller
{
    //マイリスト表示
    public function index()
    {
        if (auth()->check()) {
            $userId = auth()->user()->id;
            $favoriteItems = Favorite::where('user_id', $userId)->with('item.images')->get();
            return view('mylist', compact('favoriteItems'));
        } else {
            $message = "ログインしてください。";
            return view('mylist', compact('message'));
        }
    }

    // お気に入り登録
    public function store(Request $request)
    {
        $user_id = Auth::id();

        if (!$user_id) {
            return redirect()->route('user.login');
        }

        $item_id = $request->item_id;

        $favoriteExists = Favorite::where('user_id', $user_id)->where('item_id', $item_id)->exists();

        if (!$favoriteExists) {
            $favorite = new Favorite();
            $favorite->user_id = $user_id;
            $favorite->item_id = $item_id;
            $favorite->save();
        }

        return redirect()->back();
    }

    // お気に入り削除
    public function removeFavorite(Request $request)
    {
        $user_id = Auth::id();
        $item_id = $request->input('item_id');

        $favorite = Favorite::where('user_id', $user_id)->where('item_id', $item_id)->first();

        if ($favorite) {
            $favorite->delete();
        }

        return back();
    }
}
