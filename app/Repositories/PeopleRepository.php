<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Person;
use App\Services\StarWarsAPI\Contracts\StarWarsAPIClient;
use App\Services\StarWarsAPI\PeopleImporter;

class PeopleRepository
{
    public function findOrImport(int $swapi_id): Person
    {
        return Person::query()->where(['swapi_id' => $swapi_id])->firstOr(function () use ($swapi_id) {
            [$importer, $api] = [app()->make(PeopleImporter::class), app()->make(StarWarsAPIClient::class)];

            $importer->import(collect($api->get("/people/$swapi_id")));

            return Person::query()->where(['swapi_id' => $swapi_id])->firstOrFail();
        });
    }
}
