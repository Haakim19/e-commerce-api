<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Addresses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all(); // Fetch all users

        Addresses::factory(50)->create([
            'user_id' => $users->random()->id, // Assign random user_id
        ]);
    }
}
