<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use App\DataTransferObjects\Concerns\InteractsWithSwapiResources;

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
     * @param  array<int, string>  $residents
     * @param  array<int, string>  $films
     */
    public function __construct(
        public string $name,
        array $residents,
        array $films,
        public string $diameter,
        public string $rotation_period,
        public string $orbital_period,
        public string $gravity,
        public string $population,
        string $climate,
        string $terrain,
        public string $surface_water,
        string $url,
    ) {
        $this->climate = $this->fromCsv($climate);
        $this->terrain = $this->fromCsv($terrain);
        $this->swapi_id = $this->getSwApiId($url);
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'swapi_id' => $this->swapi_id,
            'diameter' => $this->diameter,
            'rotation_period' => $this->rotation_period,
            'orbital_period' => $this->orbital_period,
            'gravity' => $this->gravity,
            'population' => $this->population,
            'climate' => $this->climate,
            'terrain' => $this->terrain,
            'surface_water' => $this->surface_water,
        ];
    }
}
