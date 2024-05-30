<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use App\DataTransferObjects\Concerns\InteractsWithSwapiResources;
use App\Models\Planet;
use App\Repositories\PlanetRepository;

final readonly class PersonData
{
    use InteractsWithSwapiResources;

    public Planet $planet;

    public int $swapi_id;

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
        $this->swapi_id = $this->getSwApiId($url);

        /** @var PlanetRepository $planet_repository */
        $planet_repository = resolve(PlanetRepository::class);
        $this->planet = $planet_repository->findOrImport($this->getSwApiId(from: $homeworld));
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
            'planet_id' => $this->planet->id,
            'swapi_id' => $this->swapi_id,
        ];
    }
}
