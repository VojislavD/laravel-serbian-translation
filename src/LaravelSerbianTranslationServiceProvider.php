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
                __DIR__.'/../lang/sr_latin.json' => lang_path('sr.json'),
                __DIR__.'/../lang/sr_latin' => lang_path('sr')
            ], 'localization-serbian-latin');

            $this->publishes([
                __DIR__.'/../lang/sr_cyrillic.json' => lang_path('sr.json'),
                __DIR__.'/../lang/sr_cyrillic' => lang_path('sr')
            ], 'localization-serbian-cyrillic');
        }
    }
}