<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequirementSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('requirements')->insert([
            [
                'requirement_name' => 'Valid ID / Government ID',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
