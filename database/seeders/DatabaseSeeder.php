<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            GrantTypeSeeder::class,
            RequirementSeeder::class,
            GrantSeeder::class,
            GrantRequirementSeeder::class,
            RequirementSeeder::class,
            RoleSeeder::class,
            SectorSeeder::class,
            StatusSeeder::class,
        ]);
    }
}
