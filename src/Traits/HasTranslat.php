<?php


namespace ARH\Translator\Traits;

use ARH\Translator\Models\Translate;

/**
 * 
 */
trait HasTranslat
{
    
    public function translate()
    {
        return $this->morphMany(Translate::class,'to');
    }
    
}
