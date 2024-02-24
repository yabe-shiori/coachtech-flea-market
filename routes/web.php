<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\LineLoginController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//LINEログイン
Route::get('/linelogin', [LineLoginController::class, 'lineLogin'])->name('linelogin');
Route::get('/callback', [LineLoginController::class, 'callback'])->name('callback');


//google認証
Route::get('/auth/google', [GoogleLoginController::class, 'redirectToGoogle'])
    ->name('login.google');

Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])
    ->name('login.google.callback');



Route::post('/user/payment/change/{item}', [PaymentController::class, 'changePaymentMethod'])->name('payment.change');

//商品一覧ページ
Route::get('/', [ItemController::class, 'index'])->name('item.index');

//商品詳細ページ
Route::get('/item/{item}', [ItemController::class, 'show'])->name('item.show');

//出品ページ表示
Route::get('/sell', [ItemController::class, 'create'])->name('item.create');

//出品者のプロフィール画面
Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');

//マイリスト表示
Route::get('/mylist', [FavoriteController::class, 'index'])->name('mylist');

//商品検索
Route::get('/search', [ItemController::class, 'search'])->name('item.search');

//商品に対するお問い合わせ画面
Route::get('/item/{item}/contact', [CommentController::class, 'show'])->name('comment.show');

//商品に対するお問い合わせ
Route::post('/item/{item}/contact', [CommentController::class, 'store'])->name('comment.store');

//支払いページ表示
Route::get('/purchase/{item}', [PaymentController::class, 'create'])->name('payment.create');


Route::middleware(['auth:users'])->group(function () {
    //マイページ
    Route::get('/mypage', [ProfileController::class, 'index'])->name('mypage.index');

    //購入した商品一覧
    Route::get('/mypage/purchased', [ProfileController::class, 'purchasedItems'])->name('mypage.purchasedItems');

    //プロフィール編集
    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('mypage.edit');

    //プロフィール更新
    Route::patch('/mypage/profile', [ProfileController::class, 'update'])->name('mypage.update');

    //配送先変更ページ
    Route::get('/address/{item}', [ProfileController::class, 'showShippingAddressForm'])->name('profile.showShippingAddressForm');

    //配送先住所の変更
    Route::patch('/profile/shipping-address', [ProfileController::class, 'updateShippingAddress'])->name('profile.updateShippingAddress');

    //出品
    Route::post('/sell', [ItemController::class, 'store'])->name('item.store');

    //お気に入り登録
    Route::post('/favorite', [FavoriteController::class, 'store'])->name('favorite');

    //お気に入り削除
    Route::delete('/favorite', [FavoriteController::class, 'removeFavorite'])->name('removeFavorite');

    //フォロー
    Route::post('/follow/{user}', [FollowController::class, 'follow'])->name('follow');

    //フォロー解除
    Route::delete('/follow/{userId}', [FollowController::class, 'unfollow'])->name('unfollow');

    //フォロー一覧
    Route::get('/mypage/following', [FollowController::class, 'following'])->name('following');

    //フォローしているユーザーの商品一覧画面
    Route::get('/following-items/{user}', [ProfileController::class, 'show'])->name('following.items');

    //商品に対するお問い合わせ削除
    Route::delete('/item/{item}/contact/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');

    // Stripeでの支払い処理
    Route::post('/checkout/{itemId}', [StripeController::class, 'createSession'])->name('checkout');

    //決済成功時の処理
    Route::get('/success', [StripeController::class, 'success'])->name('success');

    //決済キャンセル時の処理
    Route::get('/cancel/{itemId}', [StripeController::class, 'cancel'])->name('cancel');



});

require __DIR__ . '/auth.php';
