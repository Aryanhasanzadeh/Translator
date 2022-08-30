<?php

namespace Aryanhasanzadeh\Translator\App\Http\Interface;

interface TranslatorServer {

    public function setSource(String $src);

    public function setTarget(String $src);

    public function getTranslate(String $text) : String;
}