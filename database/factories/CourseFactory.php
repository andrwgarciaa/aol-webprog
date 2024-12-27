<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->text(30),
            'lecturer_id' => $this->faker->numberBetween(1, 2),
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(0, 1000, 100000),
            'rating' => $this->faker->randomFloat(1, 0, 5),
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png',
        ];
    }
}
