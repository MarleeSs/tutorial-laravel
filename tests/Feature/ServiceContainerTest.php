<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\HelloServiceIndonesia;
use App\Data\Person;
use App\Services\HelloService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function PHPUnit\Framework\assertSame;

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
        $this->app->singleton(Bar::class, function ($app){
            return new Bar($app->make(Foo::class));
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($foo, $bar1->foo);
        assertSame($bar1, $bar2);
    }

    public function testInterfaceToClass()
    {
        $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $helloService = $this->app->make(HelloService::class);

        assertSame('Halo Indonesia', $helloService->hello("Indonesia"));
    }
}
