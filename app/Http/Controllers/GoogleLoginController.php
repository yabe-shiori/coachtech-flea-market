<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::firstOrCreate(
                [
                    'email' => $googleUser->getEmail()
                ],
                [
                    'gtoken' => $googleUser->token,
                    'name' => $googleUser->getName(),
                ]
            );
            Auth::login($user);
            return redirect()->route('user.item.index');
        } catch (Exception $e) {
            session()->flash('error', 'ログインに失敗しました。もう一度お試しください。');

            return redirect()->route('user.login');
        }
    }
}
