<?php

namespace App\Services\StarWarsAPI;

use App\DataTransferObjects\PlanetData;
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

    }
}
