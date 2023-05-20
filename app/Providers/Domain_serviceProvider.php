<?php

namespace App\Providers;

use App\Domains\Category_domain;
use App\Domains\Transaction_domain;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class Domain_serviceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Category_domain::class, function ($app) {
            return new Category_domain($app);
        });

        $this->app->singleton(Transaction_domain::class, function () {
            return new Transaction_domain();
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
