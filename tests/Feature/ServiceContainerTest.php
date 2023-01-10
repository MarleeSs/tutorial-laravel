<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    public function testDependency()
    {
        $foo1 = $this->app->make(Foo::class); // seperti new
        $foo2 = $this->app->make(Foo::class); // seperti new

        self::assertEquals("Foo Class", $foo1->foo());
        self::assertEquals("Foo Class", $foo2->foo());
        self::assertNotSame($foo1, $foo2);
    }

    public function testBind()
    {
        $this->app->bind(Person::class, function ($app) {
            return new Person('Coba', 'Aja');
        });

        $person = $this->app->make(Person::class);
        self::assertEquals('Coba', $person->first);
    }

    public function testSingleton()
    {
        $this->app->singleton(Person::class, function ($app) {
            return new Person('Coba', 'Aja');
        });

        $person1 = $this->app->make(Person::class); // Kalo ga ada, buat object
        $person2 = $this->app->make(Person::class); // kalo ada kembalikan object yg sama

        self::assertEquals('Coba', $person1->first);

        self::assertSame($person1, $person2);
    }

    public function testInstance()
    {
        // Sama seperti singleton
        $person = new Person('Coba', 'Aja');
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals('Coba', $person1->first);

        self::assertSame($person1, $person2);
    }

    public function testDependencyInjection()
    {
        $this->app->singleton(Foo::class, function ($app){
            return new Foo();
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);

        self::assertSame($foo, $bar->foo);
    }
}
