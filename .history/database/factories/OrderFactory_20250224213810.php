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
            'user_id' => User::factory(),
            'total_amount' => $this->faker->numberBetween(10, 200000),
            'status' => $this->faker->randomElement($orderStatuses),
            'shipping_address'=>$this->faker->

        ];
    }
}
