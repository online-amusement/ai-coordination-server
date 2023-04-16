<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::prefix('member')->group(function () {
    //仮登録
    Route::post('/temporary-registration', [App\Http\Controllers\RegistrationController::class, 'temporaryRegistration']);
    //本登録
    Route::post('/official-registration', [App\Http\Controllers\RegistrationController::class, 'officialRegistration']);
});

Route::middleware(['cors'])->group(function() {
    Route::prefix('member')->group(function () {
        Route::get('/', [App\Http\Controllers\MemberController::class, 'member']);
    });
});
