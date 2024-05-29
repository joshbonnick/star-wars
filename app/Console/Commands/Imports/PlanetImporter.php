<?php

declare(strict_types=1);

namespace App\Console\Commands\Imports;

use App\Jobs\ImportProcessors\PlanetImportProcessor;
use App\Services\StarWarsAPI\Contracts\StarWarsAPIClient;
use Illuminate\Console\Command;

class PlanetImporter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:planets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import planets from SWAPI.';

    /**
     * Execute the console command.
     */
    public function handle(StarWarsAPIClient $api): int
    {
        cache()->driver('array')->set('swapi:importing', 'planets');

        do {
            $response = isset($response) ? $api->get($response['next']) : $api->planets();

            if (empty($response['results'])) {
                break;
            }

            PlanetImportProcessor::dispatch($response['results']);
        } while (! is_null($response['next']));

        return static::SUCCESS;
    }
}
