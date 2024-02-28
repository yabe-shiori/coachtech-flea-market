<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Admin;
use App\Models\SoldItem;
use App\Http\Requests\AdminStoreRequest;
use App\Models\User;
use App\Mail\NotificationEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Requests\NotificationMailFormRequest;


class AdminController extends Controller
{
    //商品一覧表示
    public function index()
    {
        $items = Item::with('images')->get();

        return view('admin.item.index', compact('items'));
    }

    //管理者作成ページ表示
    public function create()
    {
        return view('admin.create');
    }

    // 管理者作成処理
    public function store(AdminStoreRequest $request)
    {
        $data = $request->validated();

        $admin = Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return redirect()->route('admin.dashboard')->with('message', '管理者が作成されました。');
    }

    // 出品者への送金額確認画面表示
    public function showSellerPayments()
    {
        $soldItems = SoldItem::with('item')->paginate(10);

        return view('admin.seller-payments', compact('soldItems'));
    }

    // お知らせメール作成ページの表示
    public function showNotificationForm()
    {
        return view('admin.notification');
    }

    // お知らせメール確認/admin
    public function confirmNotificationForm(NotificationMailFormRequest $request)
    {
        $validatedData = $request->validated();
        return view('admin.notification-confirm', $validatedData);
    }

    // お知らせメール送信
    public function sendNotification(Request $request)
    {
        $validatedData = $request->validate([
            'subject' => 'required',
            'content' => 'required',
        ]);

        $subject = $validatedData['subject'];
        $content = $validatedData['content'];

        $users = User::whereNotNull('email')->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new NotificationEmail($subject, $content));
        }

        return redirect()->route('admin.dashboard')->with('message', 'お知らせメールを送信しました。');
    }
}
