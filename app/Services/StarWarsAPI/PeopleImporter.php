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
        $people->each(fn (PersonData $person) => Person::query()->firstOrCreate(['swapi_id' => $person->swapi_id],
            $person->toArray()));
    }
}
