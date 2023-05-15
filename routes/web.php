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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix("news")->group(function () {
    Route::get('/', [App\Http\Controllers\NewsController::class, 'index'])->name('news');
    Route::get('/create', [App\Http\Controllers\NewsController::class, 'create'])->name('news.create');
    Route::get('/{id}/edit', [App\Http\Controllers\NewsController::class, 'edit'])->name('news.edit');
    Route::post('/save', [App\Http\Controllers\NewsController::class, 'save'])->name('news.save');
    Route::get('/{id}/delete', [App\Http\Controllers\NewsController::class, 'delete'])->name('news.delete');
});