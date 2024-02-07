<?php

namespace AlexGithub987\Cikk;

use Illuminate\Support\ServiceProvider;

class CikkServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/cikk.php', 'cikk');

        // Register the service the package provides.
        $this->app->singleton('cikk', function ($app) {
            return new Cikk;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['cikk'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/cikk.php' => config_path('cikk.php'),
        ], 'cikk.config');

    }
}
