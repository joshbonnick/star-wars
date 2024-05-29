<?php

declare(strict_types=1);

namespace App\Services\StarWarsAPI;

use App\Services\StarWarsAPI\Contracts\StarWarsAPIClient;
use Closure;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Cache;

class HttpClient implements StarWarsAPIClient
{
    public function __construct(protected PendingRequest $request)
    {
    }

    public function planets(): array
    {
        return $this->cache('planets', fn () => $this->request->get('planets')->json());
    }

    public function get(string $uri): array
    {
        return $this->cache($uri,
            fn (): array => $this->request->get((string) str($uri)->remove(config('swapi.base_url')))->json());
    }

    public function films(): array
    {
        return $this->cache('films', fn () => $this->request->get('films')->json());
    }

    public function people(): array
    {
        return $this->cache('people', fn () => $this->request->get('people')->json());
    }

    /**
     * @template TValue
     *
     * @param  Closure(): TValue  $closure  The closure whose result needs to be cached.
     * @return TValue The result of the closure execution.
     */
    protected function cache(string $key, Closure $closure): mixed
    {
        return Cache::remember("swapi:$key", now()->addDay(), $closure);
    }
}
