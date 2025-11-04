<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_info', function (Blueprint $table) {
            $table->string('house_no', 50)->nullable()->after('city');
            $table->string('sc_house_no', 50)->nullable()->after('sc_city');
        });
    }

    public function down(): void
    {
        Schema::table('user_info', function (Blueprint $table) {
            $table->dropColumn(['house_no', 'sc_house_no']);
        });
    }
};
