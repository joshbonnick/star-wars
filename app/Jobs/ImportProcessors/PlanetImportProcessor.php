<?php

namespace App\Jobs\ImportProcessors;

use App\DataTransferObjects\PlanetData;
use App\Services\StarWarsAPI\PlanetImporter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class PlanetImportProcessor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @param  array<int, array<string, mixed>>  $results
     */
    public function __construct(public array $results)
    {
    }

    public function handle(PlanetImporter $importer): void
    {
        $importer->import(
            planets: collect($this->results)
                ->map(fn (array $planet): Collection => collect($planet)->except(['created', 'edited']))
                ->map(fn (Collection $planet): PlanetData => new PlanetData(...$planet->toArray()))
        );
    }
}
