<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Parlay;
use App\Models\Single;
use App\Enums\SlipType;
use App\Models\DepositRequest;
use App\Models\Wallet;
use App\Models\WithdrawRequest;
use App\Services\PayoutService;
use App\Services\WalletService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Relations\Relation;

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
        Paginator::useBootstrap();
        Relation::enforceMorphMap([
            User::class => User::class,
            Wallet::class => Wallet::class,
            Wallet::class => Wallet::class,
            "deposit_request" => DepositRequest::class,
            "withdraw_request" => WithdrawRequest::class,
            SlipType::Single->value => Single::class,
            SlipType::Parlay->value => Parlay::class,
        ]);
    }
}
