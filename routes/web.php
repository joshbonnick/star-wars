<?php

declare(strict_types=1);

use App\Models\Planet;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => Planet::query()->get());
