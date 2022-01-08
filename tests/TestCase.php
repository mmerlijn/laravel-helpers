<?php

namespace mmerlijn\laravelHelpers\tests;

use mmerlijn\laravelHelpers\LaravelHelpersServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{

    //protected $loadEnvironmentVariables = true;
    public function setUp(): void
    {
        // Code before application created.

        parent::setUp();

        $this->artisan('cache:clear')->run();
        //$this->artisan('view:clear')->run();
        // Code after application created.

    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelHelpersServiceProvider::class,
        ];

    }

    protected function getEnvironmentSetUp($app)
    {
    }

    protected function getApplicationTimezone($app)
    {
        return "Europe/Amsterdam";
    }


    protected function defineEnvironment($app)
    {

        $app->loadEnvironmentFrom('../../../../tests/.env.testing'); // specify the file to use for environment, must be run before boostrap
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

    }

    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        //$this->artisan("key:generate",['--env'=>'testing'])->run();
        //$this->artisan("config:cache",['--env'=>'testing'])->run();
        $this->loadLaravelMigrations();
        $this->artisan('migrate', ['--database' => 'testbench'])->run();

        //$this->artisan('db:seed')->run();
        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:rollback', ['--database' => 'testbench'])->run();
        });

    }
}