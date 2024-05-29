<?php

declare(strict_types=1);

namespace App\Jobs\ImportProcessors;

use App\DataTransferObjects\SpeciesData;
use App\Services\StarWarsAPI\SpeciesImporter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class SpeciesImportProcessor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @param  array<int, array<string, mixed>>  $results
     */
    public function __construct(public array $results)
    {
    }

    public function handle(SpeciesImporter $importer): void
    {
        $importer->import(
            species: collect($this->results)
                ->map(fn (array $species): Collection => collect($species)->except(['created', 'edited']))
                ->map(fn (Collection $species): SpeciesData => new SpeciesData(...$species->toArray()))
        );
    }
}
