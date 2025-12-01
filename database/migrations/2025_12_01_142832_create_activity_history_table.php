<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_history', function (Blueprint $table) {
            $table->id();

            // FK to users table
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
            $table->string('type');        // example training ngaya or contribution pang identify lang
            $table->text('message');       // Full sentence shown under title
            $table->timestamps();          // created_at used for date/time display
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_history');
    }
};
