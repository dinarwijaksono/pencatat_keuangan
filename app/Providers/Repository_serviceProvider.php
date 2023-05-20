<?php

namespace App\Providers;

use App\Repository\Category_repository;
use App\Repository\User_repository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class Repository_serviceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(User_repository::class, function ($app) {
            return new User_repository($app);
        });

        $this->app->singleton(Category_repository::class, function ($app) {
            return new Category_repository($app);
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
