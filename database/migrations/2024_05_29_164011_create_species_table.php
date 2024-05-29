<?php

declare(strict_types=1);

use App\Models\Planet;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('species', function (Blueprint $table) {
            $table->id();

            $table->string('name')
                ->index()
                ->comment('The name of this species.');

            $table->integer('swapi_id')->unique();

            $table->string('classification')
                ->comment('The classification of this species, such as "mammal" or "reptile".');
            $table->string('designation')
                ->comment('The designation of this species, such as "sentient".');
            $table->string('average_height')
                ->comment('The average height of this species in centimeters.');
            $table->string('average_lifespan')
                ->comment('The average lifespan of this species in years.');

            $table->json('eye_colors')
                ->comment('A comma-separated string of common eye colors for this species, "none" if this species does not typically have eyes.');
            $table->json('hair_colors')
                ->comment('A comma-separated string of common hair colors for this species, "none" if this species does not typically have hair.');
            $table->json('skin_colors')
                ->comment('A comma-separated string of common skin colors for this species, "none" if this species does not typically have skin.');

            $table->string('language')
                ->comment('The language commonly spoken by this species.');

            $table->foreignIdFor(Planet::class)
                ->comment('The URL of a planet resource, a planet that this species originates from.')
                ->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('species');
    }
};
