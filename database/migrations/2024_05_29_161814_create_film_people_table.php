<?php

declare(strict_types=1);

use App\Models\Film;
use App\Models\Person;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('film_person', function (Blueprint $table) {
            $table->foreignIdFor(Film::class);
            $table->foreignIdFor(Person::class);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('film_people');
    }
};
