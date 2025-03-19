<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orders>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $orderStatuses = [
            'Pending',
            'Processing',
            'Shipped',
            'Delivered',
            'Completed',
            'Cancelled',
            'Refunded',
            'On Hold',
            'Failed',
            'Returned'
        ];
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'total_amount' => $this->faker->numberBetween(10, 200000),
            'status' => $this->faker->randomElement($orderStatuses),
            'shipping_address' => function (array $attributes) {
                $user = User::find($attributes['user_id']);
                $address = $user->addresses()->inRandomOrder()->first();

                // Format as a string
                return sprintf(
                    "%s, %s, %s %s,%s,%s",
                    $address->address_line_01,
                    $address->address_line_02,
                    $address->city,
                    $address->state,
                    $address->postal_code,
                    $address->country
                );
            },
            'created_at' => $this->faker->dateTimeBetween('now', '+1 month'),
            'updated_at' => $this->faker->dateTimeBetween('+1 month', '+2 months'),

        ];
    }
}
