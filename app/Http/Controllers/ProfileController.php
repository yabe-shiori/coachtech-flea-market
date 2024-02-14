<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Item;

class ProfileController extends Controller
{

    //マイぺージ表示
    public function index(Request $request): View
    {
        return view('mypage.index', [
            'user' => $request->user(),
        ]);
    }

    public function myProducts()
    {
        $products = Item::where('user_id', auth()->id())->get();
        
        return view('mypage.my-products', compact('products'));
    }


    public function edit(Request $request): View
    {
        return view('mypage.edit', [
            'user' => $request->user(),
        ]);
    }


    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $attr = [
            'name' => $request->name,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building_name' => $request->building_name,
        ];

        if ($request->hasFile('avatar')) {
            $name = $request->file('avatar')->getClientOriginalName();
            $avatar = date('Ymd_His') . '_' . $name;
            $request->file('avatar')->storeAs('public/avatar', $avatar);
            $attr['avatar'] = $avatar;
        }

        $user->update($attr);

        return redirect()->route('user.mypage.index')->with('message', 'プロフィールを更新しました。');
    }

    // public function destroy(Request $request): RedirectResponse
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $user = $request->user();

    //     Auth::logout();

    //     $user->delete();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return Redirect::to('/');
    // }
}
