<?php

declare(strict_types=1);

namespace App\Jobs\ImportProcessors;

use App\DataTransferObjects\PersonData;
use App\Services\StarWarsAPI\PeopleImporter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class PeopleImportProcessor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @param  array<int, array<string, mixed>>  $results
     */
    public function __construct(public array $results)
    {
    }

    public function handle(PeopleImporter $importer): void
    {
        $importer->import(
            people: collect($this->results)
                ->map(fn (array $person): Collection => collect($person)->except(['created', 'edited']))
                ->map(fn (Collection $person): PersonData => new PersonData(...$person->toArray()))
        );
    }
}
