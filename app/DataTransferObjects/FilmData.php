<?php

namespace App\DataTransferObjects;

class FilmData
{
    public function __construct(
        public string $title,
        public int $episode_id,
    ) {
    }
}
