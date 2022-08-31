<?php


namespace Aryanhasanzadeh\Translator\App\Http\Traits;

use Aryanhasanzadeh\Translator\Models\Translate;

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
