<?php

namespace mmerlijn\laravelHelpers;

use Illuminate\Support\ServiceProvider;
use mmerlijn\laravelHelpers\Classes\Distance;
use mmerlijn\laravelHelpers\Classes\Toast;


class LaravelHelpersServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //$this->mergeConfigFrom(
        //    __DIR__ . '/../config/config.php', 'config'
        //);

        $this->app->bind('distance', function ($app) {
            return new Distance();
        });
        $this->app->bind('toast', function ($app) {
            return new Toast();
        });
    }

    public function boot()
    {
        //$this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel-helpers');
        //$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }


}