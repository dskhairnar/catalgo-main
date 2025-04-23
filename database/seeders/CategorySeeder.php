<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Healthy Eating Programs',
                'description' => 'Nutrition and meal planning services',
                'icon' => 'fas fa-utensils',
            ],
            [
                'name' => 'Fitness & Wellness',
                'description' => 'Exercise and physical wellness services',
                'icon' => 'fas fa-dumbbell',
            ],
            [
                'name' => 'Sustainable Living',
                'description' => 'Eco-friendly and sustainable lifestyle services',
                'icon' => 'fas fa-leaf',
            ],
            [
                'name' => 'Mental Health',
                'description' => 'Mental wellness and counseling services',
                'icon' => 'fas fa-brain',
            ],
            [
                'name' => 'Eco-Friendly Products',
                'description' => 'Sustainable and environmentally friendly products',
                'icon' => 'fas fa-recycle',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
} 