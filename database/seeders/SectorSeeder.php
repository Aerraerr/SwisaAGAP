<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sectors')->insert([
            ['sector_name' => 'Agriculture', 'created_at' => now(), 'updated_at' => now()],
            ['sector_name' => 'Fisheries', 'created_at' => now(), 'updated_at' => now()],
            ['sector_name' => 'Livestock', 'created_at' => now(), 'updated_at' => now()],
            ['sector_name' => 'Forestry', 'created_at' => now(), 'updated_at' => now()],
            ['sector_name' => 'Agri-Business', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
