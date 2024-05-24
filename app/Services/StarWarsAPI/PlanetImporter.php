<?php

namespace App\Services\StarWarsAPI;

use App\DataTransferObjects\PlanetData;
use App\Models\Planet;
use App\Services\StarWarsAPI\Contracts\StarWarsAPIClient;
use Illuminate\Support\Collection;

class PlanetImporter
{
    public function __construct(protected StarWarsAPIClient $api)
    {
    }

    /**
     * @param  Collection<int, PlanetData>  $planets
     */
    public function import(Collection $planets): void
    {
        $planets = $planets
            ->map(fn (PlanetData $planet) => collect((array) $planet)->except(['films', 'residents']))
            ->map(fn (Collection $data) => [
                ...$data,
                'climate' => json_encode($data['climate']),
                'terrain' => json_encode($data['terrain']),
            ]);

        Planet::query()->insert($planets->toArray());
    }
}
