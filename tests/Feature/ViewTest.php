<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Marleess');

    }
    public function testNested()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Marleess');

    }

    public function testViewWithOutRoute()
    {
        $this->view('user.hello', ['name'=>'Marleess'])
            ->assertSeeText('Hello Marleess');
    }
}
