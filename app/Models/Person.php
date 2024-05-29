<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Person extends Model
{
    use HasFactory;

    /**
     * @return HasOne<Planet>
     */
    public function homeWorld(): HasOne
    {
        return $this->hasOne(Planet::class);
    }
}
