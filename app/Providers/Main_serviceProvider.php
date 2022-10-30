<?php

namespace App\Providers;

use App\Services\Category_service;
use Illuminate\Support\ServiceProvider;

class Main_serviceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Category_service::class, function ($app) {
            return new Category_service();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
