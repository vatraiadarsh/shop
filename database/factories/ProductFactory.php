<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'title' => $this->faker->title,
            'description' => $this->faker->text,
            'price' => $this->faker->randomFloat(2, 0, 100),
            'quantity' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->randomElement(['on', 'off']),
            'image' => $this->faker->imageUrl,
        ];
    }
}
