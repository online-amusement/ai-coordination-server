<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('/auth/login');
});

Auth::routes();

Route::middleware(['auth'])->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix("member")->group(function() {
        Route::get('/create', [App\Http\Controllers\HomeController::class, 'create'])->name('member.create');
        Route::get('/{id}/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('member.edit');
        Route::post('/save', [App\Http\Controllers\HomeController::class, 'save'])->name('member.save');
        Route::get('/{id}/delete', [App\Http\Controllers\HomeController::class, 'delete'])->name('member.delete');
    });

    Route::prefix("news")->group(function () {
        Route::get('/', [App\Http\Controllers\NewsController::class, 'index'])->name('news');
        Route::get('/create', [App\Http\Controllers\NewsController::class, 'create'])->name('news.create');
        Route::get('/{id}/edit', [App\Http\Controllers\NewsController::class, 'edit'])->name('news.edit');
        Route::post('/save', [App\Http\Controllers\NewsController::class, 'save'])->name('news.save');
        Route::get('/{id}/delete', [App\Http\Controllers\NewsController::class, 'delete'])->name('news.delete');
    });

    Route::prefix('payment')->group(function() {
        Route::get('/', [App\Http\Controllers\PaymentController::class, 'index'])->name('payment');
        Route::get('/create', [App\Http\Controllers\PaymentController::class, 'create'])->name('payment.create');
        Route::get('/{id}/edit', [App\Http\Controllers\PaymentController::class, 'edit'])->name('payment.edit');
        Route::post('/save', [App\Http\Controllers\PaymentController::class, 'save'])->name('payment.save');
        Route::get('/{id}/delete', [App\Http\Controllers\PaymentController::class, 'delete'])->name('payment.delete');
    });

    Route::prefix('summary')->group(function() {
        Route::get('/', [App\Http\Controllers\SummaryController::class, 'index'])->name('summary');
        Route::get('/{date}/show', [App\Http\Controllers\SummaryController::class, 'show'])->name('summary.show');
    });
});
