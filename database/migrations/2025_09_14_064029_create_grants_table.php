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
        Schema::create('grants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->constrained('grant_types')->onDelete('cascade'); 
            $table->string('title', 50);
            $table->text('description')->nullable();
            $table->integer('total_quantity');
            $table->integer('unit_per_request');
            $table->date('available_at', 50)->nullable();
            $table->date('end_at', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grants');
    }
};
