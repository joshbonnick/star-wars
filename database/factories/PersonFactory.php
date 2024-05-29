<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Person;
use App\Models\Planet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Person>
 */
class PersonFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'birth_year' => $this->faker->numberBetween(-50, 50).' BBY',
            'eye_color' => $this->faker->randomElement(['blue', 'brown', 'green', 'unknown', 'n/a']),
            'gender' => $this->faker->randomElement(['Male', 'Female', 'unknown', 'n/a']),
            'hair_color' => $this->faker->randomElement([
                'blond', 'brown', 'black', 'red', 'white', 'bald', 'unknown', 'n/a',
            ]),
            'height' => $this->faker->numberBetween(100, 300),
            'mass' => $this->faker->numberBetween(30, 150),
            'skin_color' => $this->faker->randomElement(['fair', 'dark', 'light', 'green', 'blue', 'red', 'unknown']),
            'planet_id' => Planet::factory(),
        ];
    }
}
