<?php

namespace Aryanhasanzadeh\Translator\Tests\Unit;

use Aryanhasanzadeh\Translator\App\Models\Translate;
use PHPUnit\Framework\TestCase;

class TranslateTest extends TestCase
{
    public function createTranslator()
    {
        $translate = Translate::factory()->create([
            'type' => 'test'
        ]);

        
    }
}
