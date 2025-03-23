<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'role' => 'super admin',
            'password' => bcrypt('superadmin123'),
        ]);

        // Create 4 admins
        User::factory(4)->create([
            'role' => 'admin',
        ]);

        User::factory(20)->create();
    }
}
