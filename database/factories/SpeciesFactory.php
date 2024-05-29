<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Planet;
use App\Models\Species;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Species>
 */
class SpeciesFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'classification' => $this->faker->randomElement([
                'mammal', 'reptile', 'amphibian', 'bird', 'fish', 'insect',
            ]),
            'designation' => $this->faker->randomElement(['sentient', 'non-sentient']),
            'average_height' => $this->faker->numberBetween(50, 300).' cm',
            'average_lifespan' => $this->faker->numberBetween(10, 500).' years',
            'eye_colors' => implode(',',
                $this->faker->randomElements(['blue', 'green', 'brown', 'black', 'red', 'none'], 3)),
            'hair_colors' => implode(',',
                $this->faker->randomElements(['blonde', 'brown', 'black', 'red', 'white', 'none'], 3)),
            'skin_colors' => implode(',',
                $this->faker->randomElements(['white', 'black', 'brown', 'green', 'blue', 'none'], 3)),
            'language' => $this->faker->languageCode,
            'planet_id' => Planet::factory(),
        ];
    }
}
