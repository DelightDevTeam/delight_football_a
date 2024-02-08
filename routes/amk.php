<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Football\FootballMaungController;

Route::group(['prefix' => 'user', 'as' => 'user.', 'namespace' => 'App\Http\Controllers\Football', 'middleware' => ['auth', 'checkBanned']], function () {

    Route::get('football/maung', [FootballMaungController::class, 'footballMaung'])->name('football.maung');

    Route::post('/mix-parlay-bet', [FootballMaungController::class, 'mixparlayBet'])->name('mixparlay.bet');
});
