<?php

namespace elreco\LaravelFortnite;

use Illuminate\Support\ServiceProvider;

class LaravelFortniteServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'elreco');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'elreco');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes/web.php');

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
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravelfortnite.php', 'laravelfortnite');

        // Register the service the package provides.
        $this->app->singleton('laravelfortnite', function ($app) {
            return new LaravelFortnite;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravelfortnite'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laravelfortnite.php' => config_path('laravelfortnite.php'),
        ], 'laravelfortnite.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/elreco'),
        ], 'laravelfortnite.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/elreco'),
        ], 'laravelfortnite.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/elreco'),
        ], 'laravelfortnite.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
