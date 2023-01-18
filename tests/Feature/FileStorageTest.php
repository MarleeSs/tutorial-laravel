<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileStorageTest extends TestCase
{
    public function testStorage()
    {
        $file = 'coba.txt';
        $fileSystem = Storage::disk('local');
        $fileSystem->put($file, 'Cobain weh');
        $content = $fileSystem->get($file);

        self::assertEquals('Cobain weh', $content);
    }
    public function testStoragePublic()
    {
        $file = 'coba.txt';
        $fileSystem = Storage::disk('public');
        $fileSystem->put($file, 'Cobain weh');
        $content = $fileSystem->get($file);

        self::assertEquals('Cobain weh', $content);
    }

}
