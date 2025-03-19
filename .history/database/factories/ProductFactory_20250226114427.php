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
        $products = (array) config('Product', []);
        if (empty($products)) {
            $products = [
                'Default Product' => 'This is a default product description.'
            ];
        }

        $productName = $this->faker->randomElement(array_keys($products));

        return [
            'category_id' => Categories::inRandomOrder()->first()->id ?? Categories::factory(),
            'name' => $productName,
            'description' => $products[$productName] ?? 'No description available.'
        ];
    }
}
