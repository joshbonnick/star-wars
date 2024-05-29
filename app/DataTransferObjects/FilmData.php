<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

class FilmData
{
    public function __construct(
        public string $title,
        public int $episode_id,
    ) {
    }
}
