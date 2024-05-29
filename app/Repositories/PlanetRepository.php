<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Jobs\ImportProcessors\PlanetImportProcessor;
use App\Models\Planet;
use App\Services\StarWarsAPI\Contracts\StarWarsAPIClient;

class PlanetRepository
{
    public function findOrImport(int $swapi_id): Planet
    {
        return Planet::query()->where(['swapi_id' => $swapi_id])->firstOr(function () use ($swapi_id) {
            $api = app()->make(StarWarsAPIClient::class);

            PlanetImportProcessor::dispatchSync([$api->get("/planets/$swapi_id")]);

            return Planet::query()->where(['swapi_id' => $swapi_id])->firstOrFail();
        });
    }
}
