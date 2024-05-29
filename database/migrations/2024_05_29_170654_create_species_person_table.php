<?php

declare(strict_types=1);

use App\Models\Person;
use App\Models\Species;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('species_person', function (Blueprint $table) {
            $table->foreignIdFor(Species::class);
            $table->foreignIdFor(Person::class);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('film_person');
    }
};
