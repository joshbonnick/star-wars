<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Concerns;

trait InteractsWithSwapiResources
{
    /**
     * @return array<int, string>
     */
    public function fromCsv(string $csv): array
    {
        return str($csv)->explode(',')->map(fn (string $item) => trim($item))->toArray();
    }

    protected function getSwApiId(string $from): int
    {
        return str($from)->replaceEnd('/', '')->afterLast('/')->numbers()->toInteger();
    }
}
