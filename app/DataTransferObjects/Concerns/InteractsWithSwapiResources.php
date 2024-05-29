<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Concerns;

use App\Models\Film;
use App\Models\Person;
use App\Models\Planet;
use App\Repositories\FilmRepository;
use App\Repositories\PeopleRepository;
use App\Repositories\PlanetRepository;
use Illuminate\Support\Collection;

trait InteractsWithSwapiResources
{
    /**
     * @return array<int, string>
     */
    public function fromCsv(string $csv): array
    {
        return str($csv)->explode(',')->map(fn (string $item) => trim($item))->toArray();
    }

    protected function getSwApiId(string $from): int
    {
        return str($from)->replaceEnd('/', '')->afterLast('/')->numbers()->toInteger();
    }

    /**
     * @param  array<int, string>  $films
     * @return Collection<int, Film>
     */
    protected function filmsFrom(array $films): Collection
    {
        /** @var FilmRepository $film_repository */
        $film_repository = resolve(FilmRepository::class);

        return collect($films)->map(fn (string $film_url
        ) => $film_repository->findOrImport($this->getSwApiId($film_url)));
    }

    /**
     * @param  array<int, string>  $people
     * @return Collection<int, Person>
     */
    protected function peopleFrom(array $people): Collection
    {
        /** @var PeopleRepository $people_repository */
        $people_repository = resolve(PeopleRepository::class);

        return collect($people)->map(fn (string $person_url
        ) => $people_repository->findOrImport($this->getSwApiId($person_url)));
    }

    /**
     * @param  array<int, string>  $planets
     * @return Collection<int, Planet>
     */
    protected function planetsFrom(array $planets): Collection
    {
        /** @var PlanetRepository $planet_repository */
        $planet_repository = resolve(PlanetRepository::class);

        return collect($planets)->map(fn (string $planet_url
        ) => $planet_repository->findOrImport($this->getSwApiId($planet_url)));
    }
}
