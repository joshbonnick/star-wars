<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use App\DataTransferObjects\Concerns\InteractsWithSwapiResources;
use App\Models\Film;
use App\Models\Planet;
use App\Repositories\PlanetRepository;
use Illuminate\Support\Collection;

final readonly class SpeciesData
{
    use InteractsWithSwapiResources;

    public int $swapi_id;

    public ?Planet $planet;

    /**
     * @var array<int,string>
     */
    public array $eye_colors;

    /**
     * @var array<int,string>
     */
    public array $hair_colors;

    /**
     * @var array<int,string>
     */
    public array $skin_colors;

    /**
     * @var Collection<int, Film>
     */
    public Collection $films;

    /**
     * @param  array<int,string>  $films
     * @param  array<int,string>  $people
     */
    public function __construct(
        public string $name,
        public string $classification,
        public string $designation,
        public string $average_height,
        public string $average_lifespan,
        string $eye_colors,
        string $hair_colors,
        string $skin_colors,
        public string $language,
        ?string $homeworld,
        string $url,
        array $films,
        array $people,
    ) {
        $this->swapi_id = $this->getSwApiId(from: $url);

        $this->eye_colors = $this->fromCsv($eye_colors);
        $this->hair_colors = $this->fromCsv($hair_colors);
        $this->skin_colors = $this->fromCsv($skin_colors);

        if (! blank($homeworld)) {
            /** @var PlanetRepository $planet_repository */
            $planet_repository = resolve(PlanetRepository::class);
            $this->planet = $planet_repository->findOrImport($this->getSwApiId(from: $homeworld));
        } else {
            $this->planet = null;
        }

        $this->films = $this->filmsFrom($films);
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'classification' => $this->classification,
            'designation' => $this->designation,
            'average_height' => $this->average_height,
            'average_lifespan' => $this->average_lifespan,
            'eye_colors' => $this->eye_colors,
            'hair_colors' => $this->hair_colors,
            'skin_colors' => $this->skin_colors,
            'language' => $this->language,
            'planet_id' => $this->planet?->id,
        ];
    }
}
