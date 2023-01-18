<?php

namespace Tests\Feature;

use Tests\TestCase;

class NamaMiddlewareTest extends TestCase
{
    public function testMiddlewareInvalid()
    {
        $this->get('/middleware/api')
            ->assertStatus(401)
            ->assertSeeText("Access Denied");
    }

    public function testMiddlewareValid()
    {
        $this->withHeader('X-API-KEY', 'CBA')
            ->get('/middleware/api')
            ->assertStatus(200);
    }

    public function testMiddlewareInvalidGroup()
    {
        $this->get('/middleware/group')
            ->assertStatus(401)
            ->assertSeeText("Access Denied");
    }

    public function testMiddlewareValidGroup()
    {
        $this->withHeader('X-API-KEY', 'CBA')
            ->get('/middleware/group')
            ->assertStatus(200);
    }
}
