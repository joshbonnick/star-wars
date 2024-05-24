<?php

namespace App\DataTransferObjects;

use Spatie\LaravelData\Data;

class PersonData extends Data
{
    public function __construct(
        public string $name,
    ) {
    }
}
