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
        $planets->each($this->create(...));
    }

    protected function create(PlanetData $from): Planet
    {
        /** @var Planet $film */
        $film = Planet::query()->create($from->toArray());

        return tap($film, function (Planet $planet) use ($from) {
            $planet->films()->sync($from->films->pluck('id'));
        });
    }
}
