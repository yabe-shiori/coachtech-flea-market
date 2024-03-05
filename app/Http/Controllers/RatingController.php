<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Item;
use App\Http\Requests\RatingRequest;

class RatingController extends Controller
{
    //評価入力画面表示
    public function create(Request $request)
    {
        $item_id = $request->input('item_id');
        $item = Item::findOrFail($item_id);
        $to_user_id = $item->seller_id;

        return view('mypage.rating', compact('to_user_id', 'item_id'));
    }

    //評価登録処理
    public function store(RatingRequest $request)
    {
        $validated = $request->validated();

        $item = Item::findOrFail($request->item_id);

        $existingRating = Rating::where('from_user_id', auth()->id())
            ->where('to_user_id', $item->user_id)
            ->exists();

        if ($existingRating) {
            return back()->with('error', 'すでにこのユーザーに対する評価が存在します');
        }

        $rating = new Rating();
        $rating->rating = $validated['rating'];
        $rating->comment = $validated['comment'];
        $rating->from_user_id = auth()->id();
        $rating->to_user_id = $item->user_id;
        $rating->save();

        return back()->with('message', '評価を登録しました');
    }
}
