<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/

Route::middleware('auth')->group(function () {
    // Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::prefix('/documents')->name('documents.')
        ->controller(DocumentController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });

    Route::prefix('/uploads')->name('uploads.')
        ->controller(UploadController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });

    Route::prefix('/requests')->name('requests.')
        ->controller(RequestController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/email', 'emailRequest')->name('email');
        });

    Route::prefix('/approval')->name('approval.')
        ->controller(ApprovalController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });

    Route::prefix('/history')->name('history.')
        ->controller(HistoryController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });

    Route::post('/logout', [MainController::class, 'logout'])->name('logout');
});
Route::middleware('guest')->group( function () {
    Route::inertia('/login', 'Auth/Login')->name('login');
});

