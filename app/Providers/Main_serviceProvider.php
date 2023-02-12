<?php

namespace App\Providers;

use App\Services\Category_service;
use App\Services\Item_service;
use App\Services\Transaction_service;
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

        $this->app->singleton(Item_service::class, function ($app) {
            return new Item_service();
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
