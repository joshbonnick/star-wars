<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use App\DataTransferObjects\Concerns\InteractsWithSwapiResources;
use App\Models\Person;
use App\Models\Planet;
use App\Repositories\PeopleRepository;
use App\Repositories\PlanetRepository;
use Illuminate\Support\Collection;

final readonly class FilmData
{
    use InteractsWithSwapiResources;

    public int $swapi_id;

    /**
     * @var Collection<int, Planet>
     */
    public Collection $planets;

    /**
     * @var Collection<int, Person>
     */
    public Collection $people;

    /**
     * @param  array<int, string>  $characters
     * @param  array<int, string>  $planets
     * @param  array<int, string>  $species
     * @param  array<int, string>  $vehicles
     * @param  array<int, string>  $starships
     */
    public function __construct(
        public string $title,
        public int $episode_id,
        public string $opening_crawl,
        public string $director,
        public string $producer,
        public string $release_date,
        array $species,
        array $starships,
        array $vehicles,
        array $characters,
        array $planets,
        string $url,
    ) {
        $this->swapi_id = $this->getSwApiId($url);

        /** @var PlanetRepository $planet_repository */
        $planet_repository = resolve(PlanetRepository::class);

        $this->planets = collect($planets)
            ->map(fn (string $planet_url) => $planet_repository->findOrImport($this->getSwApiId($planet_url)));

        /** @var PeopleRepository $people_repository */
        $people_repository = resolve(PeopleRepository::class);

        $this->people = collect($characters)
            ->map(fn (string $person_url) => $people_repository->findOrImport($this->getSwApiId($person_url)));
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'episode_id' => $this->episode_id,
            'opening_crawl' => $this->opening_crawl,
            'director' => $this->director,
            'producer' => $this->producer,
            'released_at' => $this->release_date,
        ];
    }
}
