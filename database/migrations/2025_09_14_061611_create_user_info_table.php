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
        Schema::create('user_info', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // --- USER INFO ---
            $table->string('fname', 50);
            $table->string('mname', 50)->nullable();
            $table->string('lname', 50);
            $table->string('name')->nullable(); // ADDED: For full name storage
            $table->string('suffix', 50)->nullable();
            $table->date('birthdate');
            $table->string('civil_status', 50)->nullable();
            $table->string('gender', 50);
            $table->string('contact_no', 20);
            $table->string('province', 50);
            $table->string('city', 50);
            $table->string('barangay', 50);
            $table->string('zone', 50);
            $table->string('profile_img', 255)->nullable();
            $table->string('qr_code')->unique()->nullable(); // --- ADD THIS LINE ---

            // --- AGRI INFO ---
            $table->string('farmer_type', 50)->nullable();
            $table->string('farm_location')->nullable();
            $table->string('land_size')->nullable();
            $table->string('water_source')->nullable();

            // --- SECONDARY CONTACT INFO ---
            $table->string('sc_fname', 50)->nullable();
            $table->string('sc_mname', 50)->nullable();
            $table->string('sc_lname', 50)->nullable();
            $table->string('sc_suffix', 50)->nullable();
            $table->string('sc_gender', 50)->nullable();
            $table->string('sc_contact_no', 20)->nullable();
            $table->string('sc_email')->nullable();
            $table->string('sc_province', 50)->nullable();
            $table->string('sc_city', 50)->nullable();
            $table->string('sc_barangay', 50)->nullable();
            $table->string('sc_zone', 50)->nullable();
            $table->string('relationship', 50)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_info');
    }
};

