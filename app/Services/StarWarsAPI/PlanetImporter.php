<?php

declare(strict_types=1);

namespace App\Services\StarWarsAPI;

use App\DataTransferObjects\PlanetData;
use App\Models\Planet;
use Illuminate\Support\Collection;

class PlanetImporter
{
    /**
     * @param  Collection<int, PlanetData>  $planets
     */
    public function import(Collection $planets): void
    {
        $planets->each(fn (PlanetData $planet) => Planet::query()->firstOrCreate(['swapi_id' => $planet->swapi_id],
            $planet->toArray()));
    }
}
