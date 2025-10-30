<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrantTypeSeeder extends Seeder
{
    public function run(): void
    {
        $grantTypes = [
            ['grant_type' => 'Cash Grant', 'created_at' => now(), 'updated_at' => now()],
            ['grant_type' => 'Fertilizer Grant', 'created_at' => now(), 'updated_at' => now()],
            ['grant_type' => 'Equipment Grant', 'created_at' => now(), 'updated_at' => now()],
            ['grant_type' => 'Seeds Grant', 'created_at' => now(), 'updated_at' => now()],
            ['grant_type' => 'Machinery Grant', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('grant_types')->insert($grantTypes);
    }
}
