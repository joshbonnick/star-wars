<?php

namespace App\Services\StarWarsAPI;

use App\Services\StarWarsAPI\Contracts\StarWarsAPIClient;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;

class HttpClient implements StarWarsAPIClient
{
    public function __construct(protected PendingRequest $request)
    {
    }

    /**
     * @throws ConnectionException
     */
    public function planets(): array
    {
        return $this->request->get('planets')->json();
    }

    /**
     * @throws ConnectionException
     */
    public function get(string $uri): array
    {
        return $this->request->get((string) str($uri)->remove(config('swapi.base_url')))->json();
    }

    /**
     * @throws ConnectionException
     */
    public function films(): array
    {
        return $this->request->get('films')->json();
    }

    /**
     * @throws ConnectionException
     */
    public function people(): array
    {
        return $this->request->get('people')->json();
    }
}
