<?php

namespace App\Providers;

use App\Enums\SlipType;
use App\Models\DepositRequest;
use App\Models\Parlay;
use App\Models\Single;
use App\Models\User;
use App\Models\WithdrawRequest;
use App\Services\PayoutService;
use App\Services\WalletService;
use Bavix\Wallet\Models\Wallet;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PayoutService::class, function (Application $app) {
            return new PayoutService($app->make(WalletService::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::enforceMorphMap([
            User::class=> User::class,
            Wallet::class => Wallet::class,
            Wallet::class => Wallet::class,
            "deposit_request" => DepositRequest::class,
            "withdraw_request" => WithdrawRequest::class,
            SlipType::Single->value => Single::class,
            SlipType::Parlay->value => Parlay::class,
        ]);
    }
}
