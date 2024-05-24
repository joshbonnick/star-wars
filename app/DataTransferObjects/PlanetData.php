<?php

namespace App\DataTransferObjects;

use Spatie\LaravelData\Data;

class PlanetData extends Data
{
    public int $id;

    /**
     * @param  array<int, PersonData>  $residents
     * @param  array<int, FilmData>  $films
     */
    public function __construct(
        public string $name,
        string $url,
        public array $residents,
        public array $films,
    ) {
        $this->id = str($url)->afterLast('/')->numbers()->toInteger();
    }
}
