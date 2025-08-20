<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ===== Admin User =====
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // prevent duplicates
            [
                'name' => 'Admin',
                'role' => 'admin',
                'password' => bcrypt('password123'), // default password
            ]
        );
    }
}
