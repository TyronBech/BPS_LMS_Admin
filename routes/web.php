<?php

use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Middleware\AdminAuthentication;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('test', [AdminLoginController::class, 'test']);

Route::middleware('guest', RedirectIfAuthenticated::class)->group(function () {
    Route::get('login', [AdminLoginController::class, 'index'])->name('login');
    Route::post('login', [AdminLoginController::class, 'store'])->name('login');
});
Route::prefix('admin')->middleware('auth:admin', AdminAuthentication::class)->group(function () {
    Route::get('dashboard', function(){
        return view('admin.dashboard.dashboard');
    })->name('admin.dashboard');
    Route::post('logout', [AdminLoginController::class, 'destroy'])->name('admin.logout');
});
