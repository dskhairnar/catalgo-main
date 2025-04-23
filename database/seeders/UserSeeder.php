<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '1234567890',
            'address' => '123 Admin Street',
        ]);

        // Create business user
        User::create([
            'name' => 'Business Owner',
            'email' => 'business@example.com',
            'password' => Hash::make('password'),
            'role' => 'business',
            'phone' => '2345678901',
            'address' => '456 Business Avenue',
        ]);

        // Create regular user
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '3456789012',
            'address' => '789 User Road',
        ]);
    }
}