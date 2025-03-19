<?php

namespace Database\Factories;

use App\Models\Categories;
use App\Models\Category;
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
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'name' => $productName,
            'description' => $products[$productName] ?? 'No description available.',
            'price' => $this->faker->numberBetween(100, 2000),
            'stock' => $this->faker->numberBetween(10, 200),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
