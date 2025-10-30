<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrantRequirementSeeder extends Seeder
{
    public function run(): void
    {
        $allGrantIDs = DB::table('grants')->pluck('id');
        foreach ($allGrantIDs as $grantID) {
            DB::table('grant_requirements')->insert([
                'grant_id' => $grantID,
                'requirement_id' => 1, // Only "Valid ID / Government ID"
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
