<?php

declare(strict_types=1);

namespace App\Models;

use App\DataTransferObjects\PlanetData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Planet extends Model
{
    use HasFactory;

    protected $hidden = ['swapi_id'];

    protected $guarded = ['swapi_id', 'created_at', 'updated_at'];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'terrain' => 'array',
            'climate' => 'array',
        ];
    }

    /**
     * @return HasMany<Person>
     */
    public function people(): HasMany
    {
        return $this->hasMany(Person::class);
    }

    public function dataTransferObject(): PlanetData
    {
        return new PlanetData(
            name: $this->name,
            residents: $this->people->toArray(),
            films: [],
            diameter: $this->diameter,
            rotation_period: $this->rotation_period,
            orbital_period: $this->orbital_period,
            gravity: $this->gravity,
            population: $this->population,
            climate: $this->climate,
            terrain: $this->terrain,
            surface_water: $this->surface_water,
            url: (string) $this->swapi_id,
        );
    }
}
