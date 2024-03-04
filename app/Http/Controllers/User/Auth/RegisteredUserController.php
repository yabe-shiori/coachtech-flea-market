<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Str;
use App\Models\Point;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('user.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        if ($request->invitation_code) {
            $inviter = User::where('invitation_code', $request->invitation_code)->first();

            if ($inviter) {

                $userPoints = Point::firstOrNew(['user_id' => $user->id]);
                $userPoints->balance += 500.00;
                $userPoints->save();

                $inviterPoints = Point::firstOrNew(['user_id' => $inviter->id]);
                $inviterPoints->balance += 500;
                $inviterPoints->save();

                $inviter->incrementInvitedUsersCount();
            }
        }

        $user->invitation_code = Str::random(8);
        $user->save();

        event(new Registered($user));

        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }
}
