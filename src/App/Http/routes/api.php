<?php

use Aryanhasanzadeh\Translator\App\Http\Controllers\TranslatorController;
use Illuminate\Support\Facades\Route;

if(config('Translator.use_base_api')) {
    Route::group([
        'prefix' => config('Translator.prefix'),
        'middleware' => config('Translator.middleware')
    ], function () {
    
        Route::group([
            'prefix' => config('Translator.translator_prefix'),
            'middleware' => config('Translator.translator_middleware'),
            'as'=>'translator.'
        ], function () {
    
            Route::resource('/', TranslatorController::class,[
                
            ])->only('index','show','update','destroy');
    
        });
    
    });    
}


