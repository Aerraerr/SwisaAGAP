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
        Schema::create('application_requirement_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // either membership OR grant request will use one of these
            $table->foreignId('requirement_id')->nullable()->constrained('requirements')->onDelete('cascade');
            $table->foreignId('grant_requirement_id')->nullable()->constrained('grant_requirements')->onDelete('cascade');

            $table->boolean('is_uploaded')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_requirement_statuses');
    }
};
