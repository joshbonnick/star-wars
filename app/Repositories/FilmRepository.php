<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Film;
use App\Services\StarWarsAPI\Contracts\StarWarsAPIClient;
use App\Services\StarWarsAPI\FilmImporter;

class FilmRepository
{
    public function findOrImport(int $swapi_id): Film
    {
        return Film::query()->where(['swapi_id' => $swapi_id])->firstOr(function () use ($swapi_id) {
            [$importer, $api] = [app()->make(FilmImporter::class), app()->make(StarWarsAPIClient::class)];

            $importer->import(collect($api->get("/films/$swapi_id")));

            return Film::query()->where(['swapi_id' => $swapi_id])->firstOrFail();
        });
    }
}
