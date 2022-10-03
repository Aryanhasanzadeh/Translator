<?php

namespace Aryanhasanzadeh\Translator\Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Aryanhasanzadeh\Translator\App\Models\Translate;

class TranslateFactory extends Factory
{

    protected $model= Translate::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fallback_locale=config('Translator:fallback_locale');
        return [
            'lang'=>$fallback_locale[rand(0,count($fallback_locale) -1 )],
            'type'=>config('Translator.types')[rand(0,count(config('Translator.types'))-1)],
            'data' => $this->faker->text(rand(5,600)),
        ];
    }

}
