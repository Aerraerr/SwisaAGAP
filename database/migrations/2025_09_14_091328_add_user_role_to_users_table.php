<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\password;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->after('password')->constrained('roles')->onDelete('cascade');
            $table->foreignId('status_id')->nullable()->after('role_id')->constrained('statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //drop fk
            $table->dropForeign(['role_id']);
            $table->dropForeign(['status_id']);

            //drop columns
            $table->dropColumn(['role_id', 'status_id']);
        });
    }
};
