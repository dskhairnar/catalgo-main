<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Business;
use App\Models\Category;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $businesses = Business::all();
        $categories = Category::all();

        if ($businesses->isEmpty() || $categories->isEmpty()) {
            $this->command->info('Please ensure there are businesses and categories in the database first.');
            return;
        }

        $services = [
            // Fitness & Wellness Services
            [
                'name' => 'Personal Training Session',
                'description' => 'One-on-one personal training session with a certified trainer. Includes personalized workout plan and nutrition advice.',
                'price' => 50.00,
                'duration' => 60,
                'status' => 'active',
                'category' => 'Fitness & Wellness'
            ],
            [
                'name' => 'Yoga Class',
                'description' => 'Group yoga class for all skill levels. Improve flexibility, strength, and mental well-being.',
                'price' => 25.00,
                'duration' => 90,
                'status' => 'active',
                'category' => 'Fitness & Wellness'
            ],
            [
                'name' => 'Group Fitness Class',
                'description' => 'High-energy group fitness session. Perfect for cardio and strength training.',
                'price' => 20.00,
                'duration' => 45,
                'status' => 'active',
                'category' => 'Fitness & Wellness'
            ],
            [
                'name' => 'Pilates Session',
                'description' => 'Core-strengthening Pilates session. Focus on posture and body awareness.',
                'price' => 35.00,
                'duration' => 60,
                'status' => 'active',
                'category' => 'Fitness & Wellness'
            ],

            // Health & Nutrition Services
            [
                'name' => 'Nutrition Consultation',
                'description' => 'Personalized nutrition planning and consultation. Get a customized meal plan and dietary advice.',
                'price' => 75.00,
                'duration' => 45,
                'status' => 'active',
                'category' => 'Health & Nutrition'
            ],
            [
                'name' => 'Diet Plan Creation',
                'description' => 'Custom diet plan creation based on your goals and preferences.',
                'price' => 100.00,
                'duration' => 60,
                'status' => 'active',
                'category' => 'Health & Nutrition'
            ],
            [
                'name' => 'Meal Prep Service',
                'description' => 'Weekly meal preparation service with customized menu options.',
                'price' => 150.00,
                'duration' => 120,
                'status' => 'active',
                'category' => 'Health & Nutrition'
            ],

            // Spa & Relaxation Services
            [
                'name' => 'Massage Therapy',
                'description' => 'Professional massage therapy session. Choose from Swedish, deep tissue, or sports massage.',
                'price' => 80.00,
                'duration' => 60,
                'status' => 'active',
                'category' => 'Spa & Relaxation'
            ],
            [
                'name' => 'Facial Treatment',
                'description' => 'Luxurious facial treatment with premium skincare products.',
                'price' => 65.00,
                'duration' => 45,
                'status' => 'active',
                'category' => 'Spa & Relaxation'
            ],
            [
                'name' => 'Full Body Treatment',
                'description' => 'Complete body treatment including exfoliation and moisturizing.',
                'price' => 120.00,
                'duration' => 90,
                'status' => 'active',
                'category' => 'Spa & Relaxation'
            ],

            // Beauty Services
            [
                'name' => 'Hair Styling',
                'description' => 'Professional hair styling and cutting service.',
                'price' => 45.00,
                'duration' => 60,
                'status' => 'active',
                'category' => 'Beauty'
            ],
            [
                'name' => 'Makeup Application',
                'description' => 'Professional makeup application for special occasions.',
                'price' => 55.00,
                'duration' => 45,
                'status' => 'active',
                'category' => 'Beauty'
            ],
            [
                'name' => 'Nail Care',
                'description' => 'Complete nail care service including manicure and pedicure.',
                'price' => 40.00,
                'duration' => 60,
                'status' => 'active',
                'category' => 'Beauty'
            ]
        ];

        foreach ($businesses as $business) {
            // Each business gets 3-5 random services
            $numberOfServices = rand(3, 5);
            $randomServices = array_rand($services, $numberOfServices);
            
            if (!is_array($randomServices)) {
                $randomServices = [$randomServices];
            }

            foreach ($randomServices as $index) {
                $service = $services[$index];
                $category = $categories->firstWhere('name', $service['category']);
                
                if ($category) {
                    Service::create([
                        'business_id' => $business->id,
                        'category_id' => $category->id,
                        'name' => $service['name'],
                        'description' => $service['description'],
                        'price' => $service['price'],
                        'duration' => $service['duration'],
                        'status' => $service['status']
                    ]);
                }
            }
        }
    }
}