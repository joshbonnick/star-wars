<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Person extends Model
{
    use HasFactory;

    protected $hidden = ['swapi_id'];

    protected $guarded = ['created_at', 'updated_at'];

    /**
     * @return BelongsTo<Planet, Person>
     */
    public function planet(): BelongsTo
    {
        return $this->belongsTo(Planet::class);
    }
}
