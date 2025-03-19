<?php

namespace Database\Factories;

use App\Models\Orders;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paymentMethod = [
            'PayPal',
            'Stripe',
            'Google Pay',
            'Bitcoin',
            'Bank Transfer'
        ];
        $status = [];

        return [
            'order_id' => Orders::factory(),
            'amount' => $this->faker->numberBetween(100, 20000),
            'payment_method' => $this->faker->randomElement($paymentMethod),

        ];
    }
}
