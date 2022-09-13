<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz>
 */
class QuizFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->jobTitle,
            'slug' => $this->faker->slug,
            'description' => $this->faker->paragraph,
            'time_limit' => $this->faker->numberBetween(1, 2),
            'status' => $this->faker->randomElement(['0', '1']),
        ];
    }
}
