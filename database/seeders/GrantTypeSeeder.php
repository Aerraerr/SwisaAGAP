<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrantTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('grant_types')->insert([
            ['grant_type' => 'Equipment', 'created_at' => now(), 'updated_at' => now()],
            ['grant_type' => 'Livestock', 'created_at' => now(), 'updated_at' => now()],
            ['grant_type' => 'Tools', 'created_at' => now(), 'updated_at' => now()],
            ['grant_type' => 'Fertilizer', 'created_at' => now(), 'updated_at' => now()],
            ['grant_type' => 'Feeds', 'created_at' => now(), 'updated_at' => now()],
            ['grant_type' => 'Financial Assistance', 'created_at' => now(), 'updated_at' => now()],
            ['grant_type' => 'Meats', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
