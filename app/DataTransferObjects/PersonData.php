<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use App\DataTransferObjects\Concerns\InteractsWithSwapiResources;

final readonly class PersonData
{
    use InteractsWithSwapiResources;

    public int $planet_id;

    public int $swapi_id;

    /**
     * @param  FilmData[]  $films
     * @param  FilmData[]  $species
     * @param  FilmData[]  $starships
     * @param  FilmData[]  $vehicles
     */
    public function __construct(
        public string $name,
        string $url,
        public string $birth_year,
        public string $eye_color,
        public string $gender,
        public string $hair_color,
        public string $height,
        public string $mass,
        public string $skin_color,
        string $homeworld,
        public array $films,
        public array $species,
        public array $starships,
        public array $vehicles,
    ) {
        [$this->swapi_id, $this->planet_id] = [$this->getSwApiId($url), $this->getSwApiId($homeworld)];
    }
}
