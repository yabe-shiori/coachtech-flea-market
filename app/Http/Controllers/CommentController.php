<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Comment;
use App\Http\Requests\CommentStoreRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function show($itemId)
    {
        $item = Item::findOrFail($itemId);

        return view('item.comment', compact('item'));
    }

    //コメント投稿
    public function store(CommentStoreRequest $request, $itemId)
    {
        // ログインしているユーザーのIDを取得
        $senderId = Auth::id();

        // バリデーション済みデータを取得
        $validatedData = $request->validated();

        // 商品を取得
        $item = Item::findOrFail($itemId);

        // コメントを作成して保存
        $comment = new Comment();
        $comment->body = $validatedData['body'];
        $comment->item_id = $itemId; // 商品IDを設定
        $comment->sender_id = $senderId; // sender_idを設定
        $comment->receiver_id = $item->user_id; // receiver_idを設定
        $comment->save();

        // リダイレクト
        return back()->with('message', 'コメントを投稿しました');
    }
}
