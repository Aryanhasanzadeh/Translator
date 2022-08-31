<?php

namespace Aryanhasanzadeh\Translator\Providers;

use Illuminate\Support\ServiceProvider;

class TranslatorServiceProvider extends ServiceProvider {

    public function boot()
    {

        $this->mergeConfigFrom(__DIR__.'/../config/translator.php', 'Translator');

        $this->loadRoutesFrom(__DIR__.'/../App/Http/routes/api.php');

        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->loadFactoriesFrom(__DIR__.'/../../database/factories');

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'Translator');

        $this->publish();

    }
    
    
    public function register()
    {

    }


    public function publish()
    {
        $this->publishes([
            __DIR__.'/../config/translator.php' => config_path('translator.php'),
        ],'config');

    }
}