<?php

namespace App\DataTransferObjects;

class PlanetData
{
    public int $swapi_id;

    /**
     * @var array<int, string>
     */
    public array $climate;

    /**
     * @var array<int, string>
     */
    public array $terrain;

    /**
     * @param  array<int, PersonData>  $residents
     * @param  array<int, FilmData>  $films
     */
    public function __construct(
        public string $name,
        string $url,
        public array $residents,
        public array $films,
        public string $diameter,
        public string $rotation_period,
        public string $orbital_period,
        public string $gravity,
        public string $population,
        string $climate,
        string $terrain,
        public string $surface_water,
    ) {
        $this->climate = str($climate)->explode(',')->toArray();
        $this->terrain = str($terrain)->explode(',')->toArray();
        $this->swapi_id = str($url)->replaceEnd('/', null)->afterLast('/')->numbers()->toInteger();
    }
}
