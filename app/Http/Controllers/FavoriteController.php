<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    // お気に入り登録
    public function store(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
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
