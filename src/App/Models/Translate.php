<?php

namespace Aryanhasanzadeh\Translator\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Aryanhasanzadeh\Translator\database\factories\TranslateFactory;
use Aryanhasanzadeh\Translator\App\Http\Traits\TraitUuid;

class Translate extends Model
{
    use HasFactory;
    use TraitUuid;

    protected static function newFactory()
    {
        return new TranslateFactory();
    }

    protected $fillable=[
        'id',
        'to_type',
        'to_id',
        'lang',
        'type',
        'data',
    ];


    public function to()
    {
        return $this->morphto();
    }


    public function scopeJustLang($query,$loc)
    {
        return $query->where('lang',$loc);
    }
    
    public function scopeJustType($query,$type)
    {
        if (in_array($type,config('translator.types'))) {
            return $query->where('lang',$type);
        }
    }
}
