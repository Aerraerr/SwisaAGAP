<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // grants
        Schema::table('grants', function (Blueprint $table) {
            $table->text('eligibility')->after('unit_per_request')->nullable();
        });

        // trainings
        Schema::table('trainings', function (Blueprint $table) {
            $table->text('description')->nullable()->after('title');
        });

        // participants
        Schema::table('participants', function (Blueprint $table) {
            $table->timestamp('check_in_at')->nullable()->after('user_id');
        });

        //announcements
        Schema::table('announcements', function (Blueprint $table) {
            $table->enum('audience', ['All', 'Members', 'Support Staff','Admin'])->after('image');
            $table->dateTime('end_at')->after('posted_at'); 
            $table->foreignId('status_id')->after('role_id')->constrained('statuses')->onDelete('cascade');
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // grants
        Schema::table('grants', function (Blueprint $table) {
            $table->dropColumn('eligibility');
        });

        // trainings
        Schema::table('trainings', function (Blueprint $table) {
            $table->dropColumn('description');
        });

        // participants
        Schema::table('participants', function (Blueprint $table) {
            $table->dropColumn('check_in_at');
        });

        // announcements
        Schema::table('announcements', function (Blueprint $table) {
            $table->dropForeign(['status_id']); 
            $table->dropColumn('status_id');
            $table->dropColumn(['audience', 'end_at']);
        });
    }
};
