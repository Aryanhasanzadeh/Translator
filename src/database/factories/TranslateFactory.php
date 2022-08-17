<?php

namespace ARH\Translator\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use ARH\Translator\Models\Translate;

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
        $fallback_locale=config('translator.fallback_locale');
        return [
            'lang'=>$fallback_locale[rand(0,count($fallback_locale) -1 )],
            'type'=>config('translator.types')[rand(0,count(config('translator.types'))-1)],
            'data' => $this->faker->text(rand(5,600)),
        ];
    }

}
