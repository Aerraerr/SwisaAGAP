<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequirementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('requirements')->insert([
            ['requirement_name' => 'Valid ID', 'created_at' => now(), 'updated_at' => now()],
            ['requirement_name' => 'Certificate of Residency', 'created_at' => now(), 'updated_at' => now()],
            ['requirement_name' => 'Barangay clearance', 'created_at' => now(), 'updated_at' => now()],
            ['requirement_name' => 'Photo of Farm', 'created_at' => now(), 'updated_at' => now()],
            ['requirement_name' => 'Farm Sketch/Map', 'created_at' => now(), 'updated_at' => now()],
            ['requirement_name' => 'Membership ID', 'created_at' => now(), 'updated_at' => now()],
            ['requirement_name' => 'Application Request Form', 'created_at' => now(), 'updated_at' => now()],
            ['requirement_name' => 'Birth Certificate', 'created_at' => now(), 'updated_at' => now()],
            ['requirement_name' => 'Profile Picture', 'created_at' => now(), 'updated_at' => now()],
            ['requirement_name' => 'Business Permit', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
