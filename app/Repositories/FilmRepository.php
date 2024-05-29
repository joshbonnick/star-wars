<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Jobs\ImportProcessors\FilmImportProcessor;
use App\Models\Film;
use App\Services\StarWarsAPI\Contracts\StarWarsAPIClient;

class FilmRepository
{
    public function findOrImport(int $swapi_id): Film
    {
        return Film::query()->where(['swapi_id' => $swapi_id])->firstOr(function () use ($swapi_id) {
            $api = app()->make(StarWarsAPIClient::class);

            FilmImportProcessor::dispatchSync([$api->get("/films/$swapi_id")]);

            return Film::query()->where(['swapi_id' => $swapi_id])->firstOrFail();
        });
    }
}
