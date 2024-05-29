<?php

declare(strict_types=1);

namespace App\Console\Commands\Imports;

use App\Jobs\ImportProcessors\SpeciesImportProcessor;
use App\Services\StarWarsAPI\Contracts\StarWarsAPIClient;
use Illuminate\Console\Command;

class SpeciesImporter extends Command
{
    /**
     * @var string
     */
    protected $signature = 'import:species';

    /**
     * @var string
     */
    protected $description = 'Import species from SWAPI.';

    public function handle(StarWarsAPIClient $api): int
    {
        cache()->driver('array')->set('swapi:importing', 'species');

        do {
            $response = isset($response) ? $api->get($response['next']) : $api->species();

            if (empty($response['results'])) {
                break;
            }

            SpeciesImportProcessor::dispatch($response['results']);
        } while (! is_null($response['next']));

        return static::SUCCESS;
    }
}
