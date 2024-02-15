<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\ShippingAddressUpdateRequest;
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


    // プロフィールの更新
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = auth()->user();

        // User nameの更新
        $user->name = $request->name;
        $user->save();

        $profileData = [
            'introduction' => $request->introduction,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building_name' => $request->building_name,
        ];

        if ($request->hasFile('avatar')) {
            $name = $request->file('avatar')->getClientOriginalName();
            $avatar = date('Ymd_His') . '_' . $name;
            $request->file('avatar')->storeAs('public/avatar', $avatar);
            $profileData['avatar'] = $avatar;
        }

        $user->profile()->updateOrCreate(['user_id' => $user->id], $profileData);

        return redirect()->route('user.mypage.index')->with('message', 'プロフィールを更新しました。');
    }

    // 配送先変更ページ表示
    public function showShippingAddressForm()
    {
        $user = Auth::user();
        
        $profile = $user->profile;

        return view('payment.shipping', compact('user', 'profile'));
    }

    // 配送先住所の更新
    public function updateShippingAddress(ShippingAddressUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();

        $validatedData = $request->validated();

        $user->profile()->update($validatedData);

        return redirect()->route('user.mypage.index')->with('message', '住所を変更しました');
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
