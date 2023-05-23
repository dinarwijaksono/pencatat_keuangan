<?php

namespace App\Providers;

use App\Services\Category_service;
use App\Services\Item_service;
use App\Services\Transaction_service;
use App\Services\User_service;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class Main_serviceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(User_service::class, function ($app) {
            return new User_service($app);
        });

        $this->app->singleton(Category_service::class, function ($app) {
            return new Category_service($app);
        });

        $this->app->singleton(Transaction_service::class, function ($app) {
            return new Transaction_service($app);
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
