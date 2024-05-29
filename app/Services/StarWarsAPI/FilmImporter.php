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
        $films->each($this->createFilm(...));
    }

    protected function createFilm(FilmData $from): Film
    {
        /** @var Film $film */
        $film = Film::query()->create($from->toArray());

        return tap($film, function (Film $film) use ($from) {
            $film->residents()->sync($from->people->pluck('id'));
            $film->planets()->sync($from->planets->pluck('id'));
        });
    }
}
