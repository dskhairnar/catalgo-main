<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Business;
use App\Models\Category;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $business = Business::first();
        $categories = Category::all();

        $services = [
            [
                'title' => 'Personal Training Session',
                'description' => 'One-on-one personal training session with a certified trainer',
                'price' => 50.00,
                'category_id' => $categories->where('name', 'Fitness & Wellness')->first()->id,
                'status' => 'active',
            ],
            [
                'title' => 'Nutrition Consultation',
                'description' => 'Personalized nutrition plan and consultation',
                'price' => 75.00,
                'category_id' => $categories->where('name', 'Healthy Eating Programs')->first()->id,
                'status' => 'active',
            ],
            [
                'title' => 'Yoga Class',
                'description' => 'Group yoga session for all levels',
                'price' => 25.00,
                'category_id' => $categories->where('name', 'Fitness & Wellness')->first()->id,
                'status' => 'active',
            ],
        ];

        foreach ($services as $service) {
            $service['business_id'] = $business->id;
            Service::create($service);
        }
    }
}