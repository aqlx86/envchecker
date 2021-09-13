<?php

namespace EnvChecker;

use Illuminate\Support\ServiceProvider;

class EnvCheckerServiceProvider extends ServiceProvider
{

    protected $commands = [
        'EnvChecker\Commands\CheckCommand'
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/Config/envchecker.php' => config_path('envchecker.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/envchecker.php',
            'envchecker'
        );

        $this->commands($this->commands);
    }
}
