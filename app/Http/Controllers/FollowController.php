<?php

namespace App\Http\Controllers;

use App\Models\Follow;
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

        if ($followerId == $followedUserId) {
            return redirect()->back()->with('error', 'フォローできません。');
        }

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

    // フォロー一覧
    public function following()
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'ログインしてください。');
        }

        $user = Auth::user();
        $following = $user->following;

        return view('mypage.following', compact('following'));
    }
}
