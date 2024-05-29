<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use App\DataTransferObjects\Concerns\InteractsWithSwapiResources;
use App\Models\Film;
use App\Models\Person;

final readonly class PlanetData
{
    use InteractsWithSwapiResources;

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
     * @param  array<int, Person>  $residents
     * @param  array<int, Film>  $films
     * @param  string|array<int, string>  $climate
     * @param  string|array<int, string>  $terrain
     */
    public function __construct(
        public string $name,
        public array $residents,
        public array $films,
        public string $diameter,
        public string $rotation_period,
        public string $orbital_period,
        public string $gravity,
        public string $population,
        string|array $climate,
        string|array $terrain,
        public string $surface_water,
        string $url = '',
    ) {
        $this->climate = is_string($climate)
            ? $this->fromCsv($climate)
            : $climate;

        $this->terrain = is_string($terrain)
            ? $this->fromCsv($terrain)
            : $terrain;

        $this->swapi_id = $this->getSwApiId(from: $url);
    }
}
