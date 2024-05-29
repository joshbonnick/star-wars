<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Jobs\ImportProcessors\SpeciesImportProcessor;
use App\Models\Species;
use App\Services\StarWarsAPI\Contracts\StarWarsAPIClient;

class SpeciesRepository
{
    public function findOrImport(int $swapi_id): Species
    {
        return Species::query()->where(['swapi_id' => $swapi_id])->firstOr(function () use ($swapi_id) {
            $api = app()->make(StarWarsAPIClient::class);

            SpeciesImportProcessor::dispatchSync([$api->get("/species/$swapi_id")]);

            return Species::query()->where(['swapi_id' => $swapi_id])->firstOrFail();
        });
    }
}
