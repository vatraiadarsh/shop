<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // create fake data with faker
            'user_id' => $this->faker->numberBetween(1, 10),
            'phone' => $this->faker->phoneNumber,
            'country' => $this->faker->country,
            'city' => $this->faker->city,
            'address' => $this->faker->address,
            'state' => $this->faker->state,
            'zip' => $this->faker->postcode,
            'avatar' => $this->faker->imageUrl(),

        ];
    }
}
