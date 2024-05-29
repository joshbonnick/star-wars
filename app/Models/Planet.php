<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Planet extends Model
{
    use HasFactory;

    protected $hidden = ['swapi_id'];

    protected $guarded = ['created_at', 'updated_at'];

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
     * @return BelongsToMany<Film>
     */
    public function films(): BelongsToMany
    {
        return $this->belongsToMany(Film::class);
    }

    /**
     * @return HasMany<Person>
     */
    public function people(): HasMany
    {
        return $this->hasMany(Person::class);
    }
}
