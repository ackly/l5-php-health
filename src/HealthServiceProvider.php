<?php

namespace Ackly\L5Health;

use Illuminate\Support\ServiceProvider;


/**
 * Class HealthServiceProvider
 */
class HealthServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__.'/../config/l5-health.php';
        $this->mergeConfigFrom($configPath, 'l5-health');
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__.'/../config/l5-health.php';
        $this->publishes([
            $configPath => config_path('l5-health.php'),
        ], 'config');

        \Route::group([], function($router) {
            require __DIR__.'/routes.php';
        });
    }
}