<?php

namespace Database\Seeders;

use App\Models\Requirement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembershipRequirementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('membership_requirements')->insert([
                ['requirement_id' => '1', 'created_at' => now(), 'updated_at' => now(),],
                ['requirement_id' => '3', 'created_at' => now(), 'updated_at' => now(),],
                ['requirement_id' => '8', 'created_at' => now(), 'updated_at' => now(),]
            ]);
    }
}
