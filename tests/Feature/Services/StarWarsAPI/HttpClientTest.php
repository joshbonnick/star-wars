<?php

declare(strict_types=1);

use App\Services\StarWarsAPI\HttpClient;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    Cache::setDefaultDriver('array');

    Http::preventStrayRequests();
});

function getClient(): HttpClient
{
    return new HttpClient(Http::baseUrl(config('swapi.base_url'))->retry(3)->timeout(15)->asJson()->acceptJson());
}

it('fetches and caches planets', function () {
    $response = ['results' => ['planet1', 'planet2']];

    Http::fake([
        config('swapi.base_url').'planets*' => Http::response($response),
    ]);

    $client = getClient();

    $result = $client->planets();
    expect($result)->toBe($response)
        ->and(Cache::get('swapi:planets'))->toBe($response);
});

it('fetches and caches films', function () {
    $response = ['results' => ['film1', 'film2']];

    Http::fake([
        config('swapi.base_url').'films' => Http::response($response),
    ]);

    $client = getClient();

    $result = $client->films();
    expect($result)->toBe($response)
        ->and(Cache::get('swapi:films'))->toBe($response);
});

it('fetches and caches people', function () {
    $response = ['results' => ['person1', 'person2']];

    Http::preventStrayRequests();
    Http::fake([
        config('swapi.base_url').'people' => Http::response($response),
    ]);

    $client = getClient();

    $result = $client->people();
    expect($result)->toBe($response)
        ->and(Cache::get('swapi:people'))->toBe($response);
});

it('fetches and caches arbitrary uri', function () {
    $response = ['results' => ['item1', 'item2']];
    $uri = 'some/uri';

    Http::fake([
        config('swapi.base_url').$uri => Http::response($response),
    ]);
    $client = getClient();

    $result = $client->get($uri);
    expect($result)->toBe($response)
        ->and(Cache::get("swapi:$uri"))->toBe($response);
});
