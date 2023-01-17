<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=marleess')
            ->assertSeeText('Hello marleess');
        $this->post('/input/hello', ['name'=>'marleess'])
            ->assertSeeText('Hello marleess');
    }

    public function testHelloNested()
    {
        $this->post('/input/nested/hello',[
            "name" => [
                "first" => "marleess",
                "last" => "marleess222",
            ]
        ])->assertSeeText('Hello marleess');
    }
    public function testHelloEncode()
    {
        $this->post('/input/hello/encode',[
            "name" => [
                "first" => "marleess",
            ]
        ])->assertSeeText('name')
            ->assertSeeText('first')
            ->assertSeeText('marleess');
    }
}
