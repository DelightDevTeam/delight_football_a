<?php

namespace App\Providers;

use App\Enums\SlipType;
use App\Models\DepositRequest;
use App\Models\Parlay;
use App\Models\Single;
use App\Models\User;
use App\Models\WithdrawRequest;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::enforceMorphMap([
            "user" => User::class,
            "deposit_request" => DepositRequest::class,
            "withdraw_request" => WithdrawRequest::class,
            SlipType::Single->value => Single::class,
            SlipType::Parlay->value => Parlay::class,
        ]);
    }
}
