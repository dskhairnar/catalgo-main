<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Business;
use App\Models\User;

class BusinessSeeder extends Seeder
{
    public function run(): void
    {
        $businessUser = User::where('email', 'business@example.com')->first();

        Business::create([
            'user_id' => $businessUser->id,
            'name' => 'Healthy Living Center',
            'description' => 'Your one-stop shop for all health and wellness needs',
            'address' => '123 Wellness Street, Health City',
            'phone' => '2345678901',
            'email' => 'business@example.com',
            'website' => 'https://healthyliving.example.com',
            'status' => 'approved',
        ]);
    }
} 