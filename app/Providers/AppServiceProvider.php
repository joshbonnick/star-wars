<?php

namespace App\Providers;

use App\Services\StarWarsAPI\Contracts\StarWarsAPIClient;
use App\Services\StarWarsAPI\HttpClient;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            StarWarsAPIClient::class,
            fn () => new HttpClient(
                Http::baseUrl(config('swapi.base_url'))->retry(3)->timeout(15)->asJson()->acceptJson()
            )
        );
    }
}
