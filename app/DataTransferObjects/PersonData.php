<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use App\DataTransferObjects\Concerns\InteractsWithSwapiResources;
use App\Models\Film;
use App\Models\Species;
use Illuminate\Support\Collection;

final readonly class PersonData
{
    use InteractsWithSwapiResources;

    public int $planet_id;

    public int $swapi_id;

    /**
     * @var Collection<int, Film>
     */
    public Collection $films;

    /**
     * @var Collection<int, Species>
     */
    public Collection $species;

    /**
     * @param  array<int,string>  $films
     * @param  array<int,string>  $species
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
        array $films,
        array $species,
        public array $starships,
        public array $vehicles,
    ) {
        [$this->swapi_id, $this->planet_id] = [$this->getSwApiId($url), $this->getSwApiId($homeworld)];

        $this->films = $this->filmsFrom($films);
        $this->species = $this->speciesFrom($species);
    }

    /**
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'birth_year' => $this->birth_year,
            'eye_color' => $this->eye_color,
            'gender' => $this->gender,
            'hair_color' => $this->hair_color,
            'height' => $this->height,
            'mass' => $this->mass,
            'skin_color' => $this->skin_color,
            'planet_id' => $this->planet_id,
            'swapi_id' => $this->swapi_id,
        ];
    }
}
