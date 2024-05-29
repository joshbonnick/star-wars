<?php

declare(strict_types=1);

use App\Models\Person;
use App\Models\Planet;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => Planet::query()->with('people')->get());
Route::get('/1', fn () => Person::query()->with('planet')->first());
