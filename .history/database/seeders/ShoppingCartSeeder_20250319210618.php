<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShoppingCartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function ($user) {
            ShoppingCart::factory()->create([
                'user_id' => $user->id,
                'product_id' => Product::inRandomOrder()->first()->id,
            ]);
        });
    }
}
