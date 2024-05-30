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
        $species->each(function (SpeciesData $species_data) {
            /** @var Species $species */
            $species = Species::query()->firstOrCreate(['swapi_id' => $species_data->swapi_id],
                $species_data->toArray());

            $species->films()->sync($species_data->films->pluck('id'));
        });
    }
}
