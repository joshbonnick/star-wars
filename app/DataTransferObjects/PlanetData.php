<?php

declare(strict_types=1);

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
        $this->climate = $this->fromCsv($climate);
        $this->terrain = $this->fromCsv($terrain);

        $this->swapi_id = str($url)->replaceEnd('/', '')->afterLast('/')->numbers()->toInteger();
    }

    /**
     * @return array<int, string>
     */
    public function fromCsv(string $csv): array
    {
        return str($csv)->explode(',')->map(fn (string $item) => trim($item))->toArray();
    }
}
