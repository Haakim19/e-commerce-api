<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Addresses>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function () {
                // get a random user if not create a new one
                return User::inRandomOrder()->first()->id ?? User::factory()->create()->id;
            },

            'address_line_01' => $this->faker->streetAddress(),
            'address_line_02' => $this->faker->optional()->secondaryAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'postal_code' => $this->faker->postcode(),
            'country' => $this->faker->country(),
            'created_at' => $this->faker->dateTimeBetween('now', '+1 month'),
            'updated_at' => $this->faker->dateTimeBetween('+1 months', '+5 months'),
        ];
    }
}
