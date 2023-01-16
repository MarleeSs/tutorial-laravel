<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $this->get('/coba')
            ->assertStatus(200)
            ->assertSeeText('Cobain');
    }

    public function testRedirect()
    {
        $this->get('/cobain')
            ->assertRedirect('/coba');
    }

    public function testFallback()
    {
        $this->get('/gaada')
            ->assertSeeText('Ga ada euy');
    }

    public function testRouteParameter()
    {
        $this->get('products/1')
            ->assertSeeText('Product 1');
    }

    public function testRouteParameterRegex()
    {
        $this->get('category/1')
            ->assertSeeText('Category 1');
    }

    public function testRoutParameterOptional()
    {
        $this->get('user/marleess')
            ->assertSeeText('User marleess');
        $this->get('user/')
            ->assertSeeText('User User facebook');
    }

    public function testNamedRoute()
    {
        $this->get('produk/123')
            ->assertSeeText('Link http://localhost/products/123');
        $this->get('produk-redirect/123')
            ->assertRedirect('/products/123');
    }

}
