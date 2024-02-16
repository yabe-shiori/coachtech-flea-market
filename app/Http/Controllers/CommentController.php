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
        $comments = $item->comments()->orderByDesc('created_at')->paginate(5);

        return view('item.comment', compact('item', 'comments'));
    }

    //コメント投稿
    public function store(CommentStoreRequest $request, $itemId)
    {
        // ログインチェック
        if (!Auth::check()) {
            return back()->withErrors('ログインしてください');
        }

        $senderId = Auth::id();

        $validatedData = $request->validated();

        $item = Item::findOrFail($itemId);

        $comment = new Comment();
        $comment->body = $validatedData['body'];
        $comment->item_id = $itemId;
        $comment->sender_id = $senderId;
        $comment->receiver_id = $item->user_id;
        $comment->save();

        return back()->with('message', 'コメントを投稿しました');
    }
}

