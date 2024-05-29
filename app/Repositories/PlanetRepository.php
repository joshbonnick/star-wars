<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Planet;
use App\Services\StarWarsAPI\Contracts\StarWarsAPIClient;
use App\Services\StarWarsAPI\PlanetImporter;

class PlanetRepository
{
    public function findOrImport(int $swapi_id): Planet
    {
        return Planet::query()->where(['swapi_id' => $swapi_id])->firstOr(function () use ($swapi_id) {
            [$importer, $api] = [app()->make(PlanetImporter::class), app()->make(StarWarsAPIClient::class)];

            $importer->import(collect($api->get("/planets/$swapi_id")));

            return Planet::query()->where(['swapi_id' => $swapi_id])->firstOrFail();
        });
    }
}
