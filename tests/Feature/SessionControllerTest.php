<?php

namespace Tests\Feature;

use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    public function testGetSession()
    {
        $this->withSession([
            'userId' => 'coba'
        ])->get('/session/get')
            ->assertSeeText('User ID : coba');
    }
}
