<?php

use App\Models\Planet;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => Planet::query()->get());
