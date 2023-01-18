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

    public function testInputType()
    {
        $this->post('/input/type', [
           'name' => 'Coba',
           'married' => 'true',
           'date' => '2021-10-01'
        ])->assertSeeText('Coba')->assertSeeText('true')->assertSeeText('2021-10-01');
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            "name" => [
                "first" => "Awal",
                "middle" => "Tengah",
                "last" => "Akhir"
            ]
        ])->assertSeeText("Awal")->assertSeeText("Akhir")
            ->assertDontSeeText("Tengah");
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            "username" => "awal",
            "password" => "coba",
            "admin" => "true"
        ])->assertSeeText("awal")->assertSeeText("coba")
            ->assertDontSeeText("admin");
    }

    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
            "username" => "awal",
            "password" => "coba",
            "admin" => "true"
        ])->assertSeeText("awal")->assertSeeText("coba")
            ->assertSeeText("admin")->assertSeeText("false");
    }

}
