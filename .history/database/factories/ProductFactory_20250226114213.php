<?php

namespace Database\Factories;

use App\Models\Categories;
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
    public function definition(): array
    {
        $products = config('Product');
        $productName = $this->faker->randomElement(array_keys($products));

        return [
            'category_id' => Categories::inRandomOrder()->first()->id ?? Categories::factory(),
            'name' => $this->faker->randomElement($products),
            'description' => $this->faker->sentence(),

        ];
    }
}
