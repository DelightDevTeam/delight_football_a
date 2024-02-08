<?php

use App\Http\Controllers\Api\V1\BetController;
use App\Http\Controllers\Api\V1\FixtureController;
use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\MarketController;
use App\Http\Controllers\Api\V1\ProfileController;
use App\Http\Controllers\Api\V1\SlipController;
use App\Http\Controllers\Api\V1\TestController;
use App\Http\Controllers\Api\V1\TransactionRequestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(["prefix" => "v1"], function () {
    Route::post("login", [LoginController::class, "login"]);
    Route::post("test", TestController::class);

    Route::get("markets", MarketController::class);

    Route::group(["middleware" => ["auth:sanctum"]], function () {
        Route::post("singles", [BetController::class, "storeSingle"]);
        Route::post("singles/{slip:uuid}/confirm", [BetController::class, "confirmSingle"]);
        Route::post("parlays", [BetController::class, "storeParlay"]);
        Route::post("parlays/{slip:uuid}/confirm", [BetController::class, "confirmParlay"]);

        Route::get("slips", [SlipController::class, "index"]);
        Route::get("slips/{slip:uuid}", [SlipController::class, "show"]);

        Route::get("transaction-requests", [TransactionRequestController::class, "index"]);
        Route::get("transaction-requests/{request:uuid}", [TransactionRequestController::class, "show"]);

        Route::post("deposit-requests", [TransactionRequestController::class, "storeDepositRequest"]);
        Route::post("withdraw-requests", [TransactionRequestController::class, "storeWithdrawRequest"]);

        Route::get("fixtures", FixtureController::class);

        Route::get("profile", [ProfileController::class, "show"]);
    });
});
