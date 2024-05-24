<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function starWarsRoute(string $uri): string
    {
        return config('swapi.base_url').$uri;
    }
}
