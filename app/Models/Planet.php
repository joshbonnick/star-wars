<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Planet extends Model
{
    use HasFactory;

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
     * @return BelongsToMany<Person>
     */
    public function people(): BelongsToMany
    {
        return $this->belongsToMany(Person::class);
    }
}
