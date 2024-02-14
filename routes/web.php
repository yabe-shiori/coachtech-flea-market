<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;



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





// Route::get('/dashboard', function () {
//     return view('user.dashboard');
// })->middleware(['auth:users'])->name('dashboard');


Route::middleware('auth:users')->group(function () {
    //マイページ
    Route::get('/mypage', [ProfileController::class, 'index'])->name('mypage.index');
    //プロフィール編集
    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('mypage.edit');
    Route::patch('/mypage/profile', [ProfileController::class, 'update'])->name('mypage.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
