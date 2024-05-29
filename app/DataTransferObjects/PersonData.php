<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

class PersonData
{
    public function __construct(
        public string $name,
    ) {
    }
}
