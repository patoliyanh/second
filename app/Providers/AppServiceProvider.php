<?php

namespace App\Providers;

use App\Contracts\LoggerInterface;
use App\Services\CustomLogger;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //** this is basic  binding */

        // $this->app->bind(CustomLogger::class,function($app){
        //     return new CustomLogger();
        // });

        //** this is a interface implement */
        $this->app->bind(LoggerInterface::class,CustomLogger::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
