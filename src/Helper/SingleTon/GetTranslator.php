<?php

namespace Aryanhasanzadeh\Translator\Helper\SingleTon;

use Aryanhasanzadeh\Translator\Helper\Factory\TranslatorFactory;

class GetTranslator {

    public const SERVERTYPE=[
        'google'=>'google'
    ];

    public static $instance=[];

    public static function getInstance(String $server) {

        if (!array_key_exists($server,GetTranslator::$instance)) 
            GetTranslator::$instance[$server]=(new TranslatorFactory())->create($server);

        return GetTranslator::$instance[$server];
    }
}