<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'user_unique_id' => 'TP0001',
            'fullname' => 'Test User',
            'username' => 'test_user',
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
            'alamat' => 'test no.123',
            'role' => 'admin',
        ]);
    }
}
