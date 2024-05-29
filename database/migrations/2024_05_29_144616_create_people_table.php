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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->integer('swapi_id')->unique();
            $table->string('name')
                ->comment('The name of this person.')
                ->index();
            $table->string('birth_year')
                ->comment('The birth year of the person, using the in-universe standard of BBY or ABY - Before the Battle of Yavin or After the Battle of Yavin. The Battle of Yavin is a battle that occurs at the end of Star Wars episode IV: A New Hope.');
            $table->string('eye_color')
                ->comment('The eye color of this person. Will be "unknown" if not known or "n/a" if the person does not have an eye.');
            $table->string('gender')
                ->comment('The gender of this person. Either "Male", "Female" or "unknown", "n/a" if the person does not have a gender.');
            $table->string('hair_color')
                ->comment('The hair color of this person. Will be "unknown" if not known or "n/a" if the person does not have hair.');
            $table->string('height')
                ->comment('The height of the person in centimeters.');
            $table->string('mass')
                ->comment('The mass of the person in kilograms.');
            $table->string('skin_color')
                ->comment('The skin color of this person.');

            $table->foreignIdFor(Planet::class)
                ->comment('A planet that this person was born on or inhabits.')
                ->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
