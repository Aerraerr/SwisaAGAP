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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grant_requirement_id')->nullable()->constrained('grant_requirements')->onDelete('cascade');
            $table->foreignId('status_id')->constrained('statuses')->onDelete('cascade');
            $table->string('file_path');
            $table->string('file_name')->nullable();
            $table->morphs('documentable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
