<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        ini_set('memory_limit', '1024M');
        ini_set('max_execution_time', '600');
        set_time_limit(0);

        Paginator::useBootstrapFive();
        //Paginator::useBootstrap();
    }
}
