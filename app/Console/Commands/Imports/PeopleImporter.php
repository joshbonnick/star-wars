<?php

declare(strict_types=1);

namespace App\Console\Commands\Imports;

use App\Jobs\ImportProcessors\PeopleImportProcessor;
use App\Services\StarWarsAPI\Contracts\StarWarsAPIClient;
use Illuminate\Console\Command;

class PeopleImporter extends Command
{
    /**
     * @var string
     */
    protected $signature = 'import:people';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import people from SWAPI.';

    public function handle(StarWarsAPIClient $api): int
    {
        cache()->driver('array')->set('swapi:importing', 'people');

        do {
            $response = isset($response) ? $api->get($response['next']) : $api->people();

            if (empty($response['results'])) {
                break;
            }

            PeopleImportProcessor::dispatch($response['results']);
        } while (! is_null($response['next']));

        return static::SUCCESS;
    }
}
