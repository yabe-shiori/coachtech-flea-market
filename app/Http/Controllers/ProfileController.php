<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\ShippingAddressUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\Item;
use App\Models\User;

class ProfileController extends Controller
{

    //マイぺージ表示
    public function index(Request $request): View
    {
        $user = $request->user();

        $userItems = Item::with('images')->where('user_id', $user->id)->get();

        return view('mypage.index', [
            'user' => $user,
            'userItems' => $userItems,
        ]);
    }

    // 購入商品一覧表示
    public function purchasedItems(Request $request): View
    {
        $user = $request->user();

        $purchasedItems = $user->purchasedItems()->with('item.images')->get();

        return view('mypage.purchased_items', [
            'user' => $user,
            'purchasedItems' => $purchasedItems,
        ]);
    }

    // プロフィール編集ページ表示
    public function edit(Request $request): View
    {
        return view('mypage.edit', [
            'user' => $request->user(),
        ]);
    }

    // プロフィールの更新
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $user = auth()->user();

            $user->name = $request->name;

            if ($request->hasFile('avatar')) {
                $name = $request->file('avatar')->getClientOriginalName();
                $avatar = date('Ymd_His') . '_' . $name;
                $request->file('avatar')->storeAs('public/avatar', $avatar);
                $user->avatar = $avatar;
            }

            $user->save();

            $profileData = [
                'display_name' => $request->display_name,
                'introduction' => $request->introduction,
                'postal_code' => $request->postal_code,
                'address' => $request->address,
                'building_name' => $request->building_name,
            ];

            $user->profile()->updateOrCreate(['user_id' => $user->id], $profileData);

            DB::commit();

            return redirect()->route('user.mypage.index')->with('message', 'プロフィールを更新しました。');
        } catch (\Exception $e) {

            DB::rollback();
            return back()->withErrors(['error' => 'プロフィールの更新中にエラーが発生しました。']);
        }
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

    // 出品者のプロフィール表示
    public function show(User $user): View
    {
        $userItems = Item::with('images')->where('user_id', $user->id)->get();

        return view('mypage.user-profile', [
            'user' => $user,
            'userItems' => $userItems,
        ]);
    }
}
