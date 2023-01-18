<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class EncryptionTest extends TestCase
{
    public function testEncryption()
    {
        $encryption = Crypt::encrypt('Coba');
        var_dump($encryption);
        $decrypt = Crypt::decrypt($encryption);

        self::assertEquals('Coba', $decrypt);
    }
    // TODO cookie
}
