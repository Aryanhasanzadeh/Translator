<?php

namespace Aryanhasanzadeh\Translator\Translator;

use Aryanhasanzadeh\Translator\App\Http\Interface\TranslatorServer;
use Stichoza\GoogleTranslate\GoogleTranslate as GT;


class GoogleTranslate implements TranslatorServer {


    protected $tr; 

    public function __construct()
    {
        $this->tr = new GT();
        $this->setSource('');
    }

    public function setSource(String $src)
    {
        $this->tr->setSource(!empty($src) ? $src : '');
        return $this;
    }
    
    public function setTarget(String $src)
    {
        $this->tr->setTarget($src);
        return $this;
    }

    public function getTranslate(String $text) : String
    {
        return $this->tr->translate($text);
    }

}