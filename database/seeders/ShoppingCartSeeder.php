<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\User;
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
            ShoppingCart::factory()
                ->times(10)
                ->create([
                    'user_id' => $user->id,
                    'product_id' => Product::inRandomOrder()->first()->id,
                ]);
        });
    }
}
