<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Healthy Eating Programs',
                'description' => 'Nutrition and meal planning services',
                'icon' => 'fas fa-utensils',
                'slug' => 'healthy-eating-programs',
            ],
            [
                'name' => 'Fitness & Wellness',
                'description' => 'Exercise and physical wellness services',
                'icon' => 'fas fa-dumbbell',
                'slug' => 'fitness-wellness',
            ],
            [
                'name' => 'Sustainable Living',
                'description' => 'Eco-friendly and sustainable lifestyle services',
                'icon' => 'fas fa-leaf',
                'slug' => 'sustainable-living',
            ],
            [
                'name' => 'Mental Health',
                'description' => 'Mental wellness and counseling services',
                'icon' => 'fas fa-brain',
                'slug' => 'mental-health',
            ],
            [
                'name' => 'Eco-Friendly Products',
                'description' => 'Sustainable and environmentally friendly products',
                'icon' => 'fas fa-recycle',
                'slug' => 'eco-friendly-products',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
} 