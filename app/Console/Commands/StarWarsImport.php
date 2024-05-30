<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Jobs\ImportProcessors\FilmImportProcessor;
use App\Jobs\ImportProcessors\PeopleImportProcessor;
use App\Jobs\ImportProcessors\PlanetImportProcessor;
use App\Jobs\ImportProcessors\SpeciesImportProcessor;
use App\Services\StarWarsAPI\Contracts\StarWarsAPIClient;
use Illuminate\Console\Command;

class StarWarsImport extends Command
{
    /**
     * @var string
     */
    protected $signature = 'import:swapi';

    /**
     * @var string
     */
    protected $description = 'Import resources from Star Wars API.';

    protected StarWarsAPIClient $api;

    public function handle(StarWarsAPIClient $api): int
    {
        $this->api = $api;

        $this->films()->planets()->species()->people();

        return static::SUCCESS;
    }

    protected function people(): static
    {
        do {
            $response = isset($response) ? $this->api->get($response['next']) : $this->api->people();

            if (empty($response['results'])) {
                break;
            }

            PeopleImportProcessor::dispatchSync($response['results']);
        } while (! is_null($response['next']));

        return $this;
    }

    protected function species(): static
    {
        do {
            $response = isset($response) ? $this->api->get($response['next']) : $this->api->species();

            if (empty($response['results'])) {
                break;
            }

            SpeciesImportProcessor::dispatchSync($response['results']);
        } while (! is_null($response['next']));

        return $this;
    }

    protected function planets(): static
    {
        do {
            $response = isset($response) ? $this->api->get($response['next']) : $this->api->planets();

            if (empty($response['results'])) {
                break;
            }

            PlanetImportProcessor::dispatchSync($response['results']);
        } while (! is_null($response['next']));

        return $this;
    }

    protected function films(): static
    {
        do {
            $response = isset($response) ? $this->api->get($response['next']) : $this->api->films();

            if (empty($response['results'])) {
                break;
            }

            FilmImportProcessor::dispatchSync($response['results']);
        } while (! is_null($response['next']));

        return $this;
    }
}
