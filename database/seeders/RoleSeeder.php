<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['role_name' => 'non-member', 'created_at' => now(), 'updated_at' => now()],  // ✅ Added
            ['role_name' => 'member', 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'support_staff', 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'admin', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
