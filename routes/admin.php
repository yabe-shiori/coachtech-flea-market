<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminController;



Route::middleware('guest')->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/items', [AdminController::class, 'index'])->name('item.index');
    Route::get('/create', [AdminController::class, 'create'])->name('create');
    Route::post('/create', [AdminController::class, 'store'])->name('store');
    Route::get('/seller-payments', [AdminController::class, 'showSellerPayments'])->name('showSellerPayments');
    Route::get('/send-notification', [AdminController::class, 'showNotificationForm'])->name('showNotificationForm');
    Route::get('/mail/confirmation', [AdminController::class, 'confirmNotificationForm'])->name('confirmNotificationForm');
    Route::post('/send-notification', [AdminController::class, 'sendNotification'])->name('sendNotification');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
