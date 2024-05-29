<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('planets', function (Blueprint $table) {
            $table->id();

            $table->integer('swapi_id')->unique();

            $table->string('name')
                ->comment('The name of this planet.')
                ->index();

            $table->string('diameter')
                ->comment('The diameter of this planet in kilometers.');

            $table->string('rotation_period')
                ->comment('The number of standard hours it takes for this planet to complete a single rotation on its axis.');

            $table->string('orbital_period')
                ->comment('The number of standard days it takes for this planet to complete a single orbit of its local star.');

            $table->string('gravity')
                ->comment('A number denoting the gravity of this planet, where "1" is normal or 1 standard G. "2" is twice or 2 standard Gs. "0.5" is half or 0.5 standard Gs.');

            $table->string('population')
                ->comment('The average population of sentient beings inhabiting this planet.');

            $table->json('climate')->comment('The climate of this planet.');
            $table->json('terrain')->comment('The terrain of this planet.');

            $table->string('surface_water')
                ->comment('The percentage of the planet surface that is naturally occurring water or bodies of water.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planets');
    }
};
