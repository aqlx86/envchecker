<?php

namespace Aqlx86\EnvChecker;

use Illuminate\Support\ServiceProvider;

class EnvCheckerServiceProvider extends ServiceProvider
{

    protected $commands = [
        'Aqlx86\EnvChecker\Commands\CheckCommand'
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/envchecker.php' => config_path('envchecker.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }
}
