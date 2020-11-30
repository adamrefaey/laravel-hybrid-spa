<?php

namespace MustafaRefaey\LaravelHybrid;

use Illuminate\Support\ServiceProvider;

class LaravelHybridServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/laravel-hybrid.php' => config_path('laravel-hybrid.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/laravel-hybrid'),
            ], 'views');
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel-hybrid');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-hybrid.php', 'laravel-hybrid');
    }
}
