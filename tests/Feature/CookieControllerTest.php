<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieControllerTest extends TestCase
{
    public function testCreateCookie()
    {
        $this->get('/cookie/set')
            ->assertCookie('User-Id', 'coba')
            ->assertCookie('Is-Member', 'true');
    }

    public function testGet()
    {
        $this->withCookie('User-Id', 'coba')
            ->withCookie('Is-Member', 'true')
            ->get('/cookie/get')
            ->assertJson([
                'userId' => 'coba',
                'isMember' => 'true'
            ]);
    }
}
