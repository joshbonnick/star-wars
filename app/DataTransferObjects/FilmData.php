<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use App\DataTransferObjects\Concerns\InteractsWithSwapiResources;
use App\Models\Person;
use App\Models\Planet;
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
     * @var array<int, string>
     */
    public array $producers;

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
        string $producer,
        public string $release_date,
        array $species,
        array $starships,
        array $vehicles,
        array $characters,
        array $planets,
        string $url,
    ) {
        $this->swapi_id = $this->getSwApiId($url);
        $this->producers = $this->fromCsv($producer);

        $this->planets = $this->planetsFrom($planets);
        $this->people = $this->peopleFrom($characters);
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'swapi_id' => $this->swapi_id,
            'title' => $this->title,
            'episode_id' => $this->episode_id,
            'opening_crawl' => $this->opening_crawl,
            'director' => $this->director,
            'producers' => $this->producers,
            'released_at' => $this->release_date,
        ];
    }
}
