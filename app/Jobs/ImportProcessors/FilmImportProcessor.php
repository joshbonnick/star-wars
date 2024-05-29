<?php

declare(strict_types=1);

namespace App\Jobs\ImportProcessors;

use App\DataTransferObjects\FilmData;
use App\Services\StarWarsAPI\FilmImporter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class FilmImportProcessor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @param  array<int, array<string, mixed>>  $results
     */
    public function __construct(public array $results)
    {
    }

    public function handle(FilmImporter $importer): void
    {
        $importer->import(
            films: collect($this->results)
                ->map(fn (array $film): Collection => collect($film)->except(['created', 'edited']))
                ->map(fn (Collection $films): FilmData => new FilmData(...$films->toArray()))
        );
    }
}
