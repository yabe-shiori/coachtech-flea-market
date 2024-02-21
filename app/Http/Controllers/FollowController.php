<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    // フォロー
    public function follow($followedUserId)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'ログインしてください。');
        }

        $followerId = Auth::id();

        // 既にフォローしているか確認
        if (!$this->isFollowing($followerId, $followedUserId)) {
            Follow::create([
                'follower_id' => $followerId,
                'followed_id' => $followedUserId,
            ]);
        }

        return redirect()->back()->with('message', 'フォローしました。');
    }


    // フォロー解除
    public function unfollow($followedUserId)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'ログインしてください。');
        }

        $followerId = Auth::id();

        // フォロー関係を取得して削除
        $follow = Follow::where('follower_id', $followerId)
            ->where('followed_id', $followedUserId)
            ->first();

        if ($follow) {
            $follow->delete();
        }

        return redirect()->back()->with('message', 'フォローを解除しました。');
    }

    // 指定したユーザーをフォローしているかを確認
    private function isFollowing($followerId, $followedUserId)
    {
        return Follow::where('follower_id', $followerId)
            ->where('followed_id', $followedUserId)
            ->exists();
    }
}
