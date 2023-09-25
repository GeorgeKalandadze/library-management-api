<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'img_url' => fake()->imageUrl(),
            'description' => fake()->paragraph,
            'status' => fake()->numberBetween(1, 2),
            'publish_date' => fake()->date,
        ];
    }
}
