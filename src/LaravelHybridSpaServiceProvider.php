<?php

namespace MustafaRefaey\LaravelHybridSpa;

use Illuminate\Support\ServiceProvider;

class LaravelHybridSpaServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/laravel-hybrid-spa.php' => config_path('laravel-hybrid-spa.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/laravel-hybrid-spa'),
            ], 'views');
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel-hybrid-spa');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-hybrid-spa.php', 'laravel-hybrid-spa');
    }
}
