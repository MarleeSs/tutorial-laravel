<?php

namespace App\Data;

class Person
{
    public function __construct(
        public string $first,
        public string $last
    )
    {
    }
}
