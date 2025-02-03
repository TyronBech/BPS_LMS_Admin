<?php

use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Middleware\AdminAuthentication;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

Route::get('test', [AdminLoginController::class, 'test']);

Route::middleware('guest', RedirectIfAuthenticated::class)->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');
    Route::get('login', [AdminLoginController::class, 'index'])->name('login');
    Route::post('login', [AdminLoginController::class, 'store'])->name('login');
});
Route::prefix('admin')->middleware('auth:admin', AdminAuthentication::class)->group(function () {
    Route::get('dashboard', function(){
        return view('admin.dashboard.dashboard');
    })->name('admin.dashboard');
    /*
    Route::group(['prefix' => 'report'], function () {
        Route::get('user-report',           [LogController::class, 'index'])            ->name('user-report');
        Route::post('user-report',          [LogController::class, 'retrieve'])         ->name('user-retrieve');
        Route::get('visitor-report',        [VisitorLogController::class, 'index'])     ->name('visitor-report');
        Route::post('visitor-report',       [VisitorLogController::class, 'retrieve'])  ->name('visitor-retrieve');
        Route::get('transaction',           [TransactionController::class, 'index'])    ->name('transaction');
        Route::post('transaction',          [TransactionController::class, 'getData'])  ->name('getTransactionData');
        Route::get('book-circulation',      [BookController::class, 'index'])           ->name('bookCirculation');
        Route::post('book-circulation',     [BookController::class, 'getData'])         ->name('getBookData');
    });
    Route::group(['prefix' => 'import'], function () {
        Route::get('users',                 [ImportController::class, 'index'])         ->name('import-users');
        Route::post('students-data',        [ImportController::class, 'upload'])        ->name('upload-users');
        Route::post('insert-data',          [ImportController::class, 'store'])         ->name('insert-users');
        Route::get('books',                 [ImportBookController::class, 'index'])     ->name('import-books');
        Route::post('books-data',           [ImportBookController::class, 'upload'])    ->name('upload-books');
        Route::put('insert-data',           [ImportBookController::class, 'store'])     ->name('insert-books');
    });
    Route::group(['prefix' => 'maintenance'], function () {
        Route::group(['prefix' => 'books'], function () {
            Route::get('books',             [BookMaintenanceController::class, 'index'])    ->name('books');
            Route::get('add-book',          [BookMaintenanceController::class, 'create'])   ->name('add-book');
            Route::post('add-book',         [BookMaintenanceController::class, 'store'])    ->name('store-book');
            Route::get('edit-book',         [BookMaintenanceController::class, 'edit'])     ->name('edit-book');
            Route::put('edit-book',         [BookMaintenanceController::class, 'update'])   ->name('update-book');
            Route::post('show-books',       [BookMaintenanceController::class, 'show'])     ->name('show-books');
            Route::get('delete-book',       [BookMaintenanceController::class, 'destroy'])  ->name('delete-book');
        });
        Route::group(['prefix' => 'users'], function () {
            Route::get('users',             [UserMaintenanceController::class, 'index'])    ->name('users');
            Route::get('add-user',          [UserMaintenanceController::class, 'create'])   ->name('add-user');
            Route::post('add-user',         [UserMaintenanceController::class, 'store'])    ->name('store-user');
            Route::get('edit-user',         [UserMaintenanceController::class, 'edit'])     ->name('edit-user');
            Route::put('edit-user',         [UserMaintenanceController::class, 'update'])   ->name('update-user');
            Route::get('show-users',        [UserMaintenanceController::class, 'show'])     ->name('show-users');
            Route::get('delete-user',       [UserMaintenanceController::class, 'destroy'])  ->name('delete-user');
        });
    });
    */
    Route::post('logout', [AdminLoginController::class, 'destroy'])->name('admin.logout');
});
