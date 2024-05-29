<?php

declare(strict_types=1);

namespace App\Services\StarWarsAPI;

use App\DataTransferObjects\PersonData;
use App\Models\Person;
use Illuminate\Support\Collection;

class PeopleImporter
{
    /**
     * @param  Collection<int, PersonData>  $people
     */
    public function import(Collection $people): void
    {
        /** @var Collection<int, array<string, mixed>> $people */
        $people = $people
            ->map(fn (PersonData $person) => collect((array) $person)->except([
                'films', 'species', 'starships', 'vehicles',
            ]))
            ->map(fn (Collection $person): array => [
                ...$person,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        Person::query()->insert($people->toArray());
    }
}
