<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::updateOrCreate(
            ['email' => 'admin@nightlight.com'],
            [
                'name' => 'Admin',
                'email' => 'admin@nightlight.com',
                'password' => Hash::make('admin123'),
            ]
        );

        // Call CMS seeder
        $this->call(CmsSeeder::class);
    }
}
