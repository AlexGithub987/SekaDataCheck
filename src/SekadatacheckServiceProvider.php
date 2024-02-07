<?php

namespace AlexGithub987\Sekadatacheck;

use Illuminate\Support\ServiceProvider;

class SekadatacheckServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'alexgithub987');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'alexgithub987');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

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
        $this->mergeConfigFrom(__DIR__.'/../config/sekadatacheck.php', 'sekadatacheck');

        // Register the service the package provides.
        $this->app->singleton('sekadatacheck', function ($app) {
            return new Sekadatacheck;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['sekadatacheck'];
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
            __DIR__.'/../config/sekadatacheck.php' => config_path('sekadatacheck.php'),
        ], 'sekadatacheck.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/alexgithub987'),
        ], 'sekadatacheck.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/alexgithub987'),
        ], 'sekadatacheck.assets');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/alexgithub987'),
        ], 'sekadatacheck.lang');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
