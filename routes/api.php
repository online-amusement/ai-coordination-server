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
    Route::post('/login', [App\Http\Controllers\MemberApiController::class, 'login']);

    Route::prefix('member')->group(function () {
        Route::middleware(['check.member'])->group(function() {
            Route::get('/', [App\Http\Controllers\MemberApiController::class, 'member']);
        });
        Route::post('/email-edit', [App\Http\Controllers\MemberApiController::class, 'memberEmailEdit']);
        Route::post('/nickname-edit', [App\Http\Controllers\MemberApiController::class, 'memberNicknameEdit']);
        Route::post('/password-edit', [App\Http\Controllers\MemberApiController::class, 'memberPasswordEdit']);
    });

    Route::prefix("news")->group(function () {
        Route::get("/", [App\Http\Controllers\NewsController::class, "news"]);
    });

    Route::prefix("payments")->group(function () {
        Route::get("/", [App\Http\Controllers\PaymentController::class, "payments"]);
        Route::post("/", [App\Http\Controllers\PaymentHistoryController::class, "history"]);
        Route::get("/history", [App\Http\Controllers\PaymentHistoryController::class, "historyData"]);
    });

    Route::prefix('open-ai')->group(function () {
        Route::post('/image-create', [App\Http\Controllers\OpenAiController::class, 'imageCreate']);
        Route::post('/image-edit', [App\Http\Controllers\OpenAiController::class, 'imageEdit']);
    });
});
