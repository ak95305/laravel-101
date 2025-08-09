<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        dump("register");
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        dump("boot");
    }
}
