<?php

namespace Database\Factories;

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
            'user_id' => User::factory(),
            'total_amount' => $this->faker->numberBetween(1000, 20000),
            'status' => $this->faker->randomElement($orderStatuses),

        ];
    }
}
