<?php

namespace Database\Factories;

use App\Models\Order;
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
        $paymentStatus = [
            'pending',      // Payment is initiated but not completed
            'completed',    // Payment was successful
            'failed',       // Payment attempt failed
            'refunded',     // Payment was refunded to the customer
            'cancelled'     // Payment was canceled before processing
        ];


        return [
            'order_id' => Order::inRandomOrder()->first()->id ?? Order::factory(),
            'amount' => $this->faker->numberBetween(100, 20000),
            'payment_method' => $this->faker->randomElement($paymentMethod),
            'status' => $this->faker->randomElement($paymentStatus),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
