<?php

namespace mmerlijn\laravelHelpers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use mmerlijn\laravelHelpers\Classes\Distance;
use mmerlijn\laravelHelpers\Classes\Flash;


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
        $this->app->bind('flash', function ($app) {
            return new Flash();
        });
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel-helpers');
        $this->configureComponents();
        //$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    /**
     * Configure the Jetstream Blade components.
     *
     * @return void
     */
    protected function configureComponents()
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponent('alert');
            $this->registerComponent('badge');
            $this->registerComponent('button');
            $this->registerComponent('checkbox');
            $this->registerComponent('flash');
            $this->registerComponent('input');
            $this->registerComponent('select');
            $this->registerComponent('textarea');
            $this->registerComponent('toast');
            $this->registerComponent('toggle');
        });
    }

    protected function registerComponent(string $component)
    {
        Blade::component('laravel-helpers::components.' . $component, 'mm-' . $component);
    }
}