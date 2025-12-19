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

            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->string('type');
            $table->text('message');

            $table->timestamps();
            $table->softDeletes();   // deleted_at column
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('activity_history');
    }
};
