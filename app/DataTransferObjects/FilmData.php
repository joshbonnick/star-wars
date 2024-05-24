<?php

namespace App\DataTransferObjects;

use Spatie\LaravelData\Data;

class FilmData extends Data
{
    public function __construct(
        public string $title,
        public int $episode_id,
    ) {
    }
}
