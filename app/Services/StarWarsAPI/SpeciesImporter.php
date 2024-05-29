<?php

declare(strict_types=1);

namespace App\Services\StarWarsAPI;

use App\DataTransferObjects\SpeciesData;
use App\Models\Species;
use Illuminate\Support\Collection;

class SpeciesImporter
{
    /**
     * @param  Collection<int, SpeciesData>  $species
     */
    public function import(Collection $species): void
    {
        $species->each($this->create(...));
    }

    protected function create(SpeciesData $from): Species
    {
        /** @var Species $film */
        $film = Species::query()->create($from->toArray());

        return tap($film, function (Species $species) use ($from) {
            $species->films()->sync($from->films->pluck('id'));
            $species->people()->sync($from->people->pluck('id'));
        });
    }
}
