<?php

declare(strict_types=1);

use App\DataTransferObjects\PlanetData;
use App\Services\StarWarsAPI\PlanetImporter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->planetData = [
        json_decode(stub('Payloads/planet.json'), true),
    ];
    Http::preventStrayRequests();
});

it('imports planets correctly', function () {
    $importer = resolve(PlanetImporter::class);

    $planets = collect($this->planetData)->map(fn ($planet) => new PlanetData(...collect($planet)->except('created', 'edited')->toArray()));

    $importer->import($planets);

    foreach ($planets as $planet) {
        $this->assertDatabaseHas('planets', [
            'name' => $planet->name,
        ]);
    }
});

afterEach(function () {
    Mockery::close();
});
