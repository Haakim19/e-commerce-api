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
        $AddressEntriesPerUser = 5; // Change this value as needed
        User::all()->each(function ($user) use ($AddressEntriesPerUser) {
            for ($i = 0; $i < $AddressEntriesPerUser; $i++) {
                Address::factory()->create([
                    'user_id' => $user->id,
                ]);
            }
        });
    }
}
