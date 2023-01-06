<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class AppEnvTest extends TestCase
{
    public function testAppEnv()
    {
        if (App::environment(['testing', 'prod', 'dev', 'local'])){
            self::assertTrue(true);
        }
    }

}
