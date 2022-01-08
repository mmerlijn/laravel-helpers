<?php

namespace mmerlijn\laravelHelpers;

use Illuminate\Support\ServiceProvider;
use mmerlijn\laravelHelpers\Classes\Distance;


class LaravelHelpersServiceProvider extends ServiceProvider
{
    public function register()
    {
        //$this->mergeConfigFrom(
        //    __DIR__ . '/../config/config.php', 'config'
        //);

        $this->app->bind('distance', function ($app) {
            return new Distance();
        });
    }

    public function boot()
    {
        //$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

    }
}