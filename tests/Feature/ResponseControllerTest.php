<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testView()
    {
       $this->get('/response/type/view')->assertSeeText('Hello Marleess');
    }

    public function testJson()
    {
        $this->get('/response/type/json')->assertJson([
            'first_name' => 'Marleess',
            'last_name' => 'Mss'
        ]);
    }
}
