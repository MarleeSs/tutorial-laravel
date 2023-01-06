<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigTest extends TestCase
{
    public function testConfig()
    {
        $result = config('contoh.name.first');

        self::assertEquals('MARLEESS', $result);
    }

}
