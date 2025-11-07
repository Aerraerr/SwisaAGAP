<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // ✅ Just insert status_name, no description
        DB::table('statuses')->insert([
            [
                'status_name' => 'claimed',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

    public function down(): void
    {
        DB::table('statuses')->where('status_name', 'claimed')->delete();
    }
};
