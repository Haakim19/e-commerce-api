<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categories>
 */
class CategoryFactory extends Factory
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

        return [
            'name' => $this->faker->randomElement($categories),
            'created_at' => $this->faker->dateTimeBetween('now', '+1 month'),
            'updated_at' => $this->faker->dateTimeBetween('+1 month', '+2 months'),

        ];
    }
}
