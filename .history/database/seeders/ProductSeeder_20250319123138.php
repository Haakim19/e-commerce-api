<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Categories::all();

        Product::factory(50)->create([]);
    }
}
