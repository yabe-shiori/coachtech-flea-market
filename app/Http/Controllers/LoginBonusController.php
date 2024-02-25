<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginBonusHistory;
use App\Models\Point;
use Illuminate\Support\Facades\Auth;

class LoginBonusController extends Controller
{
    public function drawLoginBonus(Request $request)
    {
        $user = Auth::user();

        $alreadyReceived = LoginBonusHistory::where('user_id', $user->id)
            ->whereDate('date_awarded', now()->toDateString())
            ->exists();

        if ($alreadyReceived) {
            return response()->json([
                'success' => false,
                'message' => '本日のログインボーナスは既に受け取っています。'
            ]);
        }

        $fortuneResult = $this->getFortuneResult();
        $bonusPoints = $this->calculateBonusPoints($fortuneResult);

        $userPoints = Point::where('user_id', $user->id)->firstOrNew(['user_id' => $user->id]);
        $userPoints->balance += $bonusPoints;
        $userPoints->save();

        LoginBonusHistory::create([
            'user_id' => $user->id,
            'points_awarded' => $bonusPoints,
            'date_awarded' => now(),
        ]);

        return response()->json([
            'success' => true,
            'points_awarded' => $bonusPoints,
            'result' => $fortuneResult
        ]);
    }

    private function getFortuneResult()
    {
        $results = ['大吉', '中吉', '小吉', '凶'];
        $randomNumber = mt_rand(1, 100);

        if ($randomNumber <= 10) {
            return '大吉';
        } elseif ($randomNumber <= 40) {
            return '中吉';
        } elseif ($randomNumber <= 90) {
            return '小吉';
        } else {
            return '凶';
        }
    }

    private function calculateBonusPoints($result)
    {
        $pointsMap = [
            '大吉' => 10,
            '中吉' => 5,
            '小吉' => 3,
            '凶' => 1,
        ];

        return $pointsMap[$result] ?? 0;
    }
}
