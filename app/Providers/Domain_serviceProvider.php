<?php

namespace App\Providers;

use App\Domains\Transaction_domain;
use Illuminate\Support\ServiceProvider;

class Domain_serviceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
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
