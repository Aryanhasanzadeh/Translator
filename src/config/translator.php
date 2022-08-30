<?php


return [
    
    'fallback_locale'=>['en','fa','hi','ar','de','it','ja','az','la','fr','sv','zh-TW'],

    'active_server'=>'google',

    'types'=>[
        'title','body'
    ],
    'user-translator'=>true,


    // base prefix 
    'prefix' => 'api',

    // base middleware
    'middleware' => ['auth:sanctum'],

    // translator api's prefix
    'translator_prefix' => 'translators',

    // translator api's middleware
    'translator_middleware' => [],
];