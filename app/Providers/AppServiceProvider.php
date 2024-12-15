<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

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
        // View::share('title', 'Dashboard');
        // // OR for specific views:
        // View::composer('v_layout.app', function ($view) {
        //     $view->with('title', 'Dashboard');
        // });
    }
}
