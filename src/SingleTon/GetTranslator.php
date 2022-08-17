<?php

namespace ARH\Translator\SingleTon;

use ARH\Translator\Factory\TranslatorFactory;

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