<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrantSeeder extends Seeder
{
    public function run(): void
    {
        $grants = [
            // Cash Grant (type_id = 1) - in PHP
            [
                'type_id' => 1,
                'title' => 'Emergency Cash Assistance',
                'description' => 'Immediate financial support for farmers in crisis. Amount: PHP 10,000.00',
                'total_quantity' => 50,
                'unit_per_request' => 1,
                'available_at' => '2025-10-01',
                'end_at' => '2025-12-31',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 1,
                'title' => 'Startup Capital Grant',
                'description' => 'Cash assistance for new farming ventures. Amount: PHP 15,000.00',
                'total_quantity' => 30,
                'unit_per_request' => 1,
                'available_at' => '2025-11-01',
                'end_at' => '2026-01-31',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Fertilizer Grant (type_id = 2) - in kg
            [
                'type_id' => 2,
                'title' => 'Organic Fertilizer Support Program',
                'description' => 'Free organic fertilizer distribution for sustainable farming. Amount: 50 kg',
                'total_quantity' => 100,
                'unit_per_request' => 1,
                'available_at' => '2025-10-15',
                'end_at' => '2026-03-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 2,
                'title' => 'Rice Crop Fertilizer Subsidy',
                'description' => 'Fertilizer assistance for rice farmers. Amount: 40 kg',
                'total_quantity' => 120,
                'unit_per_request' => 1,
                'available_at' => '2025-09-20',
                'end_at' => '2025-12-20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Equipment Grant (type_id = 3) - as is
            [
                'type_id' => 3,
                'title' => 'Small Farm Tools Distribution',
                'description' => 'Hand tools and small equipment for farm productivity. Includes shovel, rake, hoe, and watering can.',
                'total_quantity' => 60,
                'unit_per_request' => 1,
                'available_at' => '2025-10-10',
                'end_at' => '2026-02-10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 3,
                'title' => 'Irrigation Equipment Grant',
                'description' => 'Modern irrigation equipment for water efficiency. Includes drip irrigation system and sprinklers.',
                'total_quantity' => 40,
                'unit_per_request' => 1,
                'available_at' => '2025-11-05',
                'end_at' => '2026-04-05',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Seeds Grant (type_id = 4) - as is
            [
                'type_id' => 4,
                'title' => 'High-Yield Rice Seeds Program',
                'description' => 'Premium rice seed varieties for better harvest. Includes 5 bags of certified seeds.',
                'total_quantity' => 150,
                'unit_per_request' => 1,
                'available_at' => '2025-09-01',
                'end_at' => '2025-11-30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 4,
                'title' => 'Vegetable Seeds Distribution',
                'description' => 'Quality vegetable seeds for home gardens and commercial farming. Variety pack of 10+ vegetable types.',
                'total_quantity' => 200,
                'unit_per_request' => 1,
                'available_at' => '2025-10-01',
                'end_at' => '2026-01-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Machinery Grant (type_id = 5) - as is
            [
                'type_id' => 5,
                'title' => 'Tractor Rental Subsidy',
                'description' => 'Financial support for tractor rental during planting season. Up to 10 days of rental.',
                'total_quantity' => 25,
                'unit_per_request' => 1,
                'available_at' => '2025-11-15',
                'end_at' => '2026-03-30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 5,
                'title' => 'Threshing Machine Access Program',
                'description' => 'Subsidized use of modern threshing machines. Access for harvest season.',
                'total_quantity' => 35,
                'unit_per_request' => 1,
                'available_at' => '2025-12-01',
                'end_at' => '2026-05-31',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 5,
                'title' => 'Water Pump Equipment Grant',
                'description' => 'Support for purchasing or leasing water pumps. 1 unit gasoline-powered water pump.',
                'total_quantity' => 30,
                'unit_per_request' => 1,
                'available_at' => '2025-10-20',
                'end_at' => '2026-02-28',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('grants')->insert($grants);
    }
}
