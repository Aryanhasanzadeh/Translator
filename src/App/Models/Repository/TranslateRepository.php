<?php

namespace Aryanhasanzadeh\Translator\App\Models\Repository;

use Aryanhasanzadeh\Translator\App\Jobs\DoTranslateJob;
use Aryanhasanzadeh\Translator\App\Models\Translate;
use Aryanhasanzadeh\Translator\Helper\SingleTon\GetTranslator;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TranslateRepository{

    protected $lang='';
    protected $type='';
    protected $data='';
    protected $parent;
    protected $translate=null;
    protected $useTranslator=false;
    protected Translate $translateModel;


    protected function checkLocaleArray()
    {
        if(!is_array(config('Translator.fallback_locale'))){
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


    public function find(string $parentType, string $find)
    {
        $this->checkLang();

        return Translate::where('to_type', $parentType)
            ->where('lang', $this->lang)
            ->where('data', 'like','%'.$find.'%')
            ->get();
    }

    public function checkParent()
    {
        if(!$this->parent instanceof Model){
            throw new Exception("parent not set", 1);
        }
    }
    
    public function checkLang()
    {
        if(empty($this->lang)){
            throw new Exception("language not set", 1);
        }
    }

    public function manageUpdateOrInsert()
    {
        $this->checkLocaleArray();

        $this->checkParent();

        $this->checkLang();

        if (!$this->useTranslator) {
            $x = $this->parent->translate()->updateOrCreate(
                [
                    'lang'=>$this->lang,
                    'type'=>$this->type,
                    'data'=>$this->data
                ]
            );
        }else{
            $TranslateManager = GetTranslator::getInstance(config('Translator.active_server'))
                ->setSource($this->lang);
            foreach (config('Translator.fallback_locale') as $lang) {
                // dd($TranslateManager->setTarget($lang)->getTranslate($this->data));
                // dispatch((new DoTranslateJob($lang,$this->data,$this->type,$this->parent))->delay(2));
                $this->parent->translate()->updateOrCreate(
                    [
                        'lang'=>$lang,
                        'type'=>$this->type,
                    ],
                    [
                        'data'=>$TranslateManager->setTarget($lang)->getTranslate($this->data)
                    ]
                );
            }
        }
        return ;
    }

    public function setTranslator($useTranslator)
    {
        $this->useTranslator=$useTranslator;
        return $this;
    }

    public function setTranslate(Translate $translate)
    {
        $this->translateModel=$translate;
        return $this;
    }
    


    public function get(Request $request)
    {
        return Translate::latest()->paginate();
    }

    

    public function update(String $data)
    {
        $this->checkTranslatorModel();

        $this->translateModel->update([
            'data' => $data
        ]);
        return $this;
    }

    public function delete()
    {
        $this->checkTranslatorModel();

        $this->translateModel->delete();
    }

    public function getTranslateModel()
    {
        $this->checkTranslatorModel();
        return $this->translateModel;
    }


    private function checkTranslatorModel()
    {
        if(!$this->translateModel instanceof Translate){
            throw new Exception("Translate model not set", 1);
        }
    }

}