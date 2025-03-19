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
        User::all()->each(function ($user) {
            Address::factory()->create(['user_id' => $user->id]);
        });
    }
}
