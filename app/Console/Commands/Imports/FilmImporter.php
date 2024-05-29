<?php

declare(strict_types=1);

namespace App\Console\Commands\Imports;

use App\Jobs\ImportProcessors\FilmImportProcessor;
use App\Services\StarWarsAPI\Contracts\StarWarsAPIClient;
use Illuminate\Console\Command;

class FilmImporter extends Command
{
    /**
     * @var string
     */
    protected $signature = 'import:films';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import people from SWAPI.';

    public function handle(StarWarsAPIClient $api): int
    {
        cache()->driver('array')->set('swapi:importing', 'films');

        do {
            $response = isset($response) ? $api->get($response['next']) : $api->films();

            if (empty($response['results'])) {
                break;
            }

            FilmImportProcessor::dispatch($response['results']);
        } while (! is_null($response['next']));

        return static::SUCCESS;
    }
}
