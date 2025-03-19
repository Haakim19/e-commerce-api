<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Orders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function ($user) {
            Orders::factory()->create(['user_id' => $user->id]);
        });
    }
}
