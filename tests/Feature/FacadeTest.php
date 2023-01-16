<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class FacadeTest extends TestCase
{
    public function testConfig()
    {
        $firstName1 = config('contoh.name.first');
        $firstName2 = Config::get('contoh.name.first');

        assertEquals($firstName1, $firstName2);
    }

    public function testFacadeMock()
    {
        Config::shouldReceive('GET')->with('contoh.name.first')->andReturn('Marleess');

        $firstName = Config::get('contoh.name.first');

        assertEquals('Marleess', $firstName);

    }


}
