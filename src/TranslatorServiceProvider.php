<?php

namespace ARH\Translator;

use Illuminate\Support\ServiceProvider;

class TranslatorServiceProvider extends ServiceProvider {

    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/translator.php' => config_path('translator.php'),
        ]);

        // $this->loadRoutesFrom(__DIR__.'/routes/api.php');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadFactoriesFrom(__DIR__.'/database/factories');
    }
    
    
    public function register()
    {

    }
}