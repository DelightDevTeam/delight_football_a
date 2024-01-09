<?php

namespace App\Providers;

use App\Enums\SlipType;
use App\Models\Parlay;
use App\Models\Single;
use App\Models\User;
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
            SlipType::Single->value => Single::class,
            SlipType::Parlay->value => Parlay::class,
        ]);
    }
}
