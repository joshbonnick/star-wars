<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Film;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Film>
 */
class FilmFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'episode_id' => $this->faker->randomDigitNotNull(),
            'opening_crawl' => $this->faker->paragraph(),
            'director' => $this->faker->name(),
            'producers' => [$this->faker->name(), $this->faker->name()],
            'released_at' => $this->faker->date(),
        ];
    }
}
