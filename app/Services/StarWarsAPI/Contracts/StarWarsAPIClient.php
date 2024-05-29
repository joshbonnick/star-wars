<?php

declare(strict_types=1);

namespace App\Services\StarWarsAPI\Contracts;

interface StarWarsAPIClient
{
    /**
     * @return array<array-key, mixed>
     */
    public function get(string $uri): array;

    /**
     * @return array{count: int, next: ?string, previous: ?string, results: array<int, array<string, mixed>>}
     */
    public function planets(): array;

    /**
     * @return array{count: int, next: ?string, previous: ?string, results: array<int, array<string, mixed>>}
     */
    public function films(): array;

    /**
     * @return array{count: int, next: ?string, previous: ?string, results: array<int, array<string, mixed>>}
     */
    public function people(): array;

    /**
     * @return array{count: int, next: ?string, previous: ?string, results: array<int, array<string, mixed>>}
     */
    public function species(): array;
}
