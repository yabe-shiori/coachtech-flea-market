<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Comment;
use App\Http\Requests\CommentStoreRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // コメント表示
    public function show($itemId)
    {
        $item = Item::findOrFail($itemId);
        $comments = $item->comments()->orderByDesc('created_at')->paginate(5);

        if (Auth::check() && $item->user_id === Auth::id()) {
            foreach ($comments as $comment) {
                if (!$comment->read_at && $comment->sender_id !== $item->user_id) {
                    $comment->read_at = now();
                    $comment->save();
                }
            }
        }

        return view('item.comment', compact('item', 'comments'));
    }

    //コメント投稿
    public function store(CommentStoreRequest $request, $itemId)
    {
        if (!Auth::check()) {
            return back()->with('error', 'ログインしてください');
        }

        $item = Item::findOrFail($itemId);
        if ($item->is_sold) {
            return back()->with('error', 'こちらの商品は売り切れなのでコメントできません。');
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

    // コメント削除
    public function destroy($itemId, $commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $item = $comment->item;

        if ($item->user_id !== Auth::id() && $comment->sender_id !== Auth::id()) {
            return back();
        }

        $comment->delete();

        return back()->with('message', 'コメントを削除しました');
    }
}
