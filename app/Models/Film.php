<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Film extends Model
{
    use HasFactory;

    protected $hidden = ['swapi_id'];

    protected $guarded = ['swapi_id', 'created_at', 'updated_at'];

    /**
     * @return BelongsToMany<Person>
     */
    public function residents(): BelongsToMany
    {
        return $this->belongsToMany(Person::class);
    }

    /**
     * @return BelongsToMany<Planet>
     */
    public function planets(): BelongsToMany
    {
        return $this->belongsToMany(Planet::class);
    }
}
