<?php

declare(strict_types=1);

namespace App\Services\StarWarsAPI;

use App\DataTransferObjects\PlanetData;
use App\Models\Planet;
use Illuminate\Support\Collection;

class PlanetImporter
{
    public function __construct()
    {
    }

    /**
     * @param  Collection<int, PlanetData>  $planets
     */
    public function import(Collection $planets): void
    {
        /** @var Collection<int, array<string, mixed>> $planets */
        $planets = $planets
            ->map(fn (PlanetData $planet) => collect((array) $planet)->except(['films', 'residents']))
            ->map(fn (Collection $planet): array => [
                ...$planet,
                'climate' => json_encode($planet['climate']),
                'terrain' => json_encode($planet['terrain']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        Planet::query()->insert($planets->toArray());
    }
}
