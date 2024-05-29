<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Species;
use App\Services\StarWarsAPI\Contracts\StarWarsAPIClient;
use App\Services\StarWarsAPI\SpeciesImporter;

class SpeciesRepository
{
    public function findOrImport(int $swapi_id): Species
    {
        return Species::query()->where(['swapi_id' => $swapi_id])->firstOr(function () use ($swapi_id) {
            [$importer, $api] = [app()->make(SpeciesImporter::class), app()->make(StarWarsAPIClient::class)];

            $importer->import(collect($api->get("/species/$swapi_id")));

            return Species::query()->where(['swapi_id' => $swapi_id])->firstOrFail();
        });
    }
}
