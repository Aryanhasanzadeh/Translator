<?php


namespace Aryanhasanzadeh\Translator\App\Http\Traits;

use Aryanhasanzadeh\Translator\App\Models\Translate;

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
