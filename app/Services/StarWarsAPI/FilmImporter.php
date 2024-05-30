<?php

declare(strict_types=1);

namespace App\Services\StarWarsAPI;

use App\DataTransferObjects\FilmData;
use App\Models\Film;
use Illuminate\Support\Collection;

class FilmImporter
{
    /**
     * @param  Collection<int, FilmData>  $films
     */
    public function import(Collection $films): void
    {
        $films->each(fn (FilmData $film) => Film::query()->firstOrCreate(['swapi_id' => $film->swapi_id],
            $film->toArray()));
    }
}
