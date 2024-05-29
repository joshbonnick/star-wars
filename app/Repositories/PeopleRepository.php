<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Jobs\ImportProcessors\PeopleImportProcessor;
use App\Models\Person;
use App\Services\StarWarsAPI\Contracts\StarWarsAPIClient;

class PeopleRepository
{
    public function findOrImport(int $swapi_id): Person
    {
        return Person::query()->where(['swapi_id' => $swapi_id])->firstOr(function () use ($swapi_id) {
            $api = app()->make(StarWarsAPIClient::class);

            PeopleImportProcessor::dispatchSync([$api->get("/people/$swapi_id")]);

            return Person::query()->where(['swapi_id' => $swapi_id])->firstOrFail();
        });
    }
}
