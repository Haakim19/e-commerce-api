<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the number of wishlist entries per user
        $wishlistEntriesPerUser = 5; // Change this value as needed

        // Loop through all users
        User::all()->each(function ($user) use ($wishlistEntriesPerUser) {
            // Create the specified number of wishlist entries for the user
            for ($i = 0; $i < $wishlistEntriesPerUser; $i++) {
                Wishlist::factory()->create([
                    'user_id' => $user->id,
                    'product_id' => Product::inRandomOrder()->first()->id,
                ]);
            }
        });
    }
}
