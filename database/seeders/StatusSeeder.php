<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statuses')->insert([
            //user status
            ['status_name' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['status_name' => 'inactive', 'created_at' => now(), 'updated_at' => now()],
            //applications status
            ['status_name' => 'pending', 'created_at' => now(), 'updated_at' => now()],
            ['status_name' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['status_name' => 'completed', 'created_at' => now(), 'updated_at' => now()],
            ['status_name' => 'rejected', 'created_at' => now(), 'updated_at' => now()],
            //reports status
            ['status_name' => 'to_be_review', 'created_at' => now(), 'updated_at' => now()],
            ['status_name' => 'good', 'created_at' => now(), 'updated_at' => now()],
            ['status_name' => 'fair', 'created_at' => now(), 'updated_at' => now()],
            ['status_name' => 'poor', 'created_at' => now(), 'updated_at' => now()],
            ['status_name' => 'damaged', 'created_at' => now(), 'updated_at' => now()],
            //trainings status
            ['status_name' => 'open', 'created_at' => now(), 'updated_at' => now()],
            ['status_name' => 'end', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
