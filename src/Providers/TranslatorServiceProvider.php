<?php


namespace Aryanhasanzadeh\Translator\Providers;

use Illuminate\Support\ServiceProvider;

class TranslatorServiceProvider extends ServiceProvider {

    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/Translator.php', 'Translator');

        $this->publish();

        $this->loadRoutesFrom(__DIR__.'/../App/Http/routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'translator');

 
    }
    
    public function register()
    {
    }


    public function publish()
    {
        $this->publishes([
            __DIR__.'/../config/translator.php' => "{$this->app->configPath()}/'translator.php'",
        ],'translator-config');
    }
}