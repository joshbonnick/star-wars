<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Planet>
 */
class PlanetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'swapi_id' => $this->faker->unique()->numberBetween(0, 100),
            'name' => $this->faker->word,
            'diameter' => $this->faker->randomNumber(5).' km',
            'rotation_period' => $this->faker->numberBetween(10, 50).' hours',
            'orbital_period' => $this->faker->numberBetween(200, 1000).' days',
            'gravity' => $this->faker->randomFloat(1, 0, 2).' G',
            'population' => $this->faker->numberBetween(1000, 10000000),
            'climate' => json_encode($this->faker->randomElements(['tropical', 'dry', 'temperate', 'polar'])),
            'terrain' => json_encode($this->faker->randomElements([
                'mountains', 'plains', 'deserts', 'oceans',
            ])),
            'surface_water' => $this->faker->numberBetween(0, 100).'%',
        ];
    }
}
