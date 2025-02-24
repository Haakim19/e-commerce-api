<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categories>
 */
class CategorieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Clothing',
            'Electronics',
            'Home Goods',
            'Personal Care',
            'Sports & Outdoors',
            'Toys & Games',
            'Health & Wellness',
            'Automotive',
            'Books & Media',
            'Grocery & Gourmet Food'
        ];

        // Generate a random category
        $randomCategory = $this->faker->randomElement($categories);

        return [
            'name' => $this->faker->name(),

        ];
    }
}
