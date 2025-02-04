<?php

use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Middleware\AdminAuthentication;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Report\LogsController;
use App\Http\Controllers\Report\VisitorLogsController;
use App\Http\Controllers\Report\TransactionController;
use App\Http\Controllers\Report\BookCirculationController;
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
        return view('dashboard.dashboard');
    })->name('dashboard');
    Route::group(['prefix' => 'report'], function () {
        Route::get('user-report',           [LogsController::class, 'index'])                   ->name('report.user');
        Route::post('user-report',          [LogsController::class, 'retrieve'])                ->name('report.user-retrieve');
        Route::get('visitor-report',        [VisitorLogsController::class, 'index'])            ->name('report.visitor');
        Route::post('visitor-report',       [VisitorLogsController::class, 'retrieve'])         ->name('report.visitor-retrieve');
        Route::get('transaction',           [TransactionController::class, 'index'])            ->name('report.transaction');
        Route::post('transaction',          [TransactionController::class, 'retrieve'])         ->name('report.transaction-retrieve');
        Route::get('book-circulation',      [BookCirculationController::class, 'index'])        ->name('report.book-circulation');
        Route::post('book-circulation',     [BookCirculationController::class, 'retrieve'])     ->name('report.book-circulation-retrieve');
    });
        /*
    /*
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
