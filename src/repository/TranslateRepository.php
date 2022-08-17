<?php

namespace ARH\Translator\repository;

use Exception;
use Illuminate\Database\Eloquent\Model;
use ARH\Translator\SingleTon\GetTranslator;

class TranslateRepository{

    protected $lang='';
    protected $type='';
    protected $data='';
    protected $parent;
    protected $translate=null;
    protected $useTranslator=false;


    protected function checkLocaleArray()
    {
        if(!is_array(config('translator.fallback_locale'))){
            throw new Exception("Fallback Locale not set as Array", 1);
        }
    }

    public function setLang(String $lang)
    {
        $this->checkLocaleArray();
        $this->lang=$lang;
        return $this;
    }
    
    public function setType(String $type)
    {
        $this->type=$type;
        return $this;
    }
    
    public function setData(String $data)
    {
        $this->data=$data;
        return $this;
    }

    public function setParent(Model $parent)
    {
        $this->parent=$parent;
        return $this;
    }

    public function manageUpdateOrInsert()
    {
        $this->checkLocaleArray();

        foreach (config('translator.fallback_locale') as $lang) {
            $this->lang=$lang;
            $this->setLang($lang)->updateOrInsert();
        }
        return ;
    }

    public function setTranslator($useTranslator)
    {
        $this->useTranslator=$useTranslator;
        return $this;
    }
    

    private function updateOrInsert()
    {
        if ($this->useTranslator) {
            $tr=GetTranslator::getInstance(config('translator.active_server'));
            $this->translate=$tr->setTarget($this->lang)->getTranslate($this->data);
        }else{
            $this->translate=$this->data;
        }

        if(!$this->parent instanceof Model){
            throw new Exception("parent not set", 1);
        }


        return $this->parent->translate()->updateOrCreate(
            [
                'lang'=>$this->lang,
                'type'=>$this->type,
                'data'=>$this->translate
            ]
        );
    }

}