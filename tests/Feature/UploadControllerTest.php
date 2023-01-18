<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UploadControllerTest extends TestCase
{
    public function testUpload()
    {
        $file = 'coba.png';
        $picture = UploadedFile::fake()->image($file, '200', '200');

        $this->post('/upload/file', ['picture' => $picture])
            ->assertSeeText("Success uploaded $file");
    }

}
