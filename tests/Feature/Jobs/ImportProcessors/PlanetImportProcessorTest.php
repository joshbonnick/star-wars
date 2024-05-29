<?php

declare(strict_types=1);

use App\Jobs\ImportProcessors\PlanetImportProcessor;
use App\Models\Planet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->planetData = [
        json_decode(stub('Payloads/planet.json'), true),
    ];
    Http::preventStrayRequests();
});

it('processes and imports planets correctly', function () {
    PlanetImportProcessor::dispatchSync($this->planetData);
    $this->assertDatabaseHas(Planet::class, ['name' => 'Tatooine']);
});

afterEach(function () {
    Mockery::close();
});
