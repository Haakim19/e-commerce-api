<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wishlistEntriesPerUser = 5; // Change this value as needed
        User::all()->each(function ($user) {
            for ($i = 0; $i < $wishlistEntriesPerUser; $i++) {
                Address::factory()->create([
                    'user_id' => $user->id,
                ]);
            }
        });
        // Define the number of wishlist entries per user

        // Loop through all users
        User::all()->each(function ($user) use ($wishlistEntriesPerUser) {
            // Create the specified number of wishlist entries for the user

        });
    }
}
