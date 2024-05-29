<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Species extends Model
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
            'eye_colors' => 'array',
            'hair_colors' => 'array',
            'skin_colors' => 'array',
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
     * @return BelongsToMany<Person>
     */
    public function people(): BelongsToMany
    {
        return $this->belongsToMany(Person::class);
    }
}
