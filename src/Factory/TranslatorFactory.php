<?php

namespace ARH\Translator\Factory;

use ARH\Translator\SingleTon\GetTranslator;
use ARH\Translator\Translator\GoogleTranslate;
use Exception;


class TranslatorFactory {

    public function create(String $server) {

        if (!array_key_exists($server,GetTranslator::SERVERTYPE))
            throw new Exception("Server Not Found", 1);

        switch ($server) {
            case GetTranslator::SERVERTYPE['google']:
                return new GoogleTranslate();
        }
    }
}