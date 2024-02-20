<?php

namespace App\Providers;

use Laravel\Sanctum\Sanctum;
use App\Models\PersonalTokenModel;
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
    public function boot()
    {
        Sanctum::usePersonalAccessTokenModel(PersonalTokenModel::class);
    }
}
