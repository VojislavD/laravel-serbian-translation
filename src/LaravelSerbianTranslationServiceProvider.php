<?php

namespace VojislavD\LaravelSerbianTranslation;

use Illuminate\Support\ServiceProvider;
use VojislavD\LaravelSerbianTranslation\Console\Commands\InstallLaravelSerbianTranslation;

class LaravelSerbianTranslationServiceProvider extends ServiceProvider
{
    public function register()
    {
        
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallLaravelSerbianTranslation::class,
            ]);

            $this->publishes([
                __DIR__.'/../resources/lang/sr.json' => resource_path('lang/sr.json'),
                __DIR__.'/../resources/lang/sr' => resource_path('lang/sr')
            ], 'localization-serbian');
        }
    }
}