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
        $people->each($this->create(...));
    }

    protected function create(PersonData $from): Person
    {
        /** @var Person $film */
        $film = Person::query()->create($from->toArray());

        return tap($film, function (Person $person) use ($from) {
            $person->films()->sync($from->films->pluck('id'));
        });
    }
}
