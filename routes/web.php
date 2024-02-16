<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\StripeController;


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


Route::get('/', [ItemController::class, 'index'])->name('item.index');
//商品詳細ページ
Route::get('/item/{item}', [ItemController::class, 'show'])->name('item.show');
//出品ページ
Route::get('/sell', [ItemController::class, 'create'])->name('item.create');
//出品
Route::post('/sell', [ItemController::class, 'store'])->name('item.store');

//商品検索
Route::get('/search', [ItemController::class, 'search'])->name('item.search');

//お気に入り登録
Route::post('/favorite', [FavoriteController::class, 'store'])->name('favorite.store');

//商品に対するお問い合わせ画面
Route::get('/item/{item}/contact', [CommentController::class, 'show'])->name('comment.show');

//商品に対するお問い合わせ
Route::post('/item/{item}/contact', [CommentController::class, 'store'])->name('comment.store');

//配送先変更ページ
Route::get('/address/{item}', [ProfileController::class, 'showShippingAddressForm'])->name('profile.showShippingAddressForm');

//配送先住所の変更
Route::patch('/profile/shipping-address', [ProfileController::class, 'updateShippingAddress'])->name('profile.updateShippingAddress');

// Stripe
Route::post('/checkout/{itemId}', [StripeController::class, 'createSession'])->name('checkout');

Route::get('/success', [StripeController::class, 'success'])->name('success');
Route::get('/cancel', [StripeController::class, 'cancel'])->name('cancel');



Route::middleware('auth:users')->group(function () {
    //マイページ
    Route::get('/mypage', [ProfileController::class, 'index'])->name('mypage.index');
    //プロフィール編集
    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('mypage.edit');
    Route::patch('/mypage/profile', [ProfileController::class, 'update'])->name('mypage.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//支払いページ
Route::get('/purchase/{item}', [PaymentController::class, 'create'])->name('payment.create');



Route::get('/mypage/products', [ProfileController::class, 'myProducts'])->name('mypage.products');
require __DIR__ . '/auth.php';
