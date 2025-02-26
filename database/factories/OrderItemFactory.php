<?php

namespace Database\Factories;

use App\Models\Orders;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Orders::inRandomOrder()->first()->id ??
                Orders::factory(), // Creates a new order or use existing order
            'product_id' => Product::inRandomOrder()->first()->id ??
                Product::factory(), // Creates a new product or use existing product
            'quantity' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
