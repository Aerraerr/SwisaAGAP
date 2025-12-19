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

            // --- USER BASIC INFO ---
            $table->string('fname', 50);
            $table->string('mname', 50)->nullable();
            $table->string('lname', 50);
            $table->string('name', 255)->nullable(); // Full name
            $table->string('suffix', 50)->nullable();
            $table->date('birthdate')->nullable();
            $table->string('civil_status', 50)->nullable();
            $table->string('gender', 50)->nullable();
            
            // --- CONTACT INFO ---
            $table->string('contact_info', 100)->nullable(); // Raw input (email or phone)
            $table->string('phone_no', 20)->nullable();      // Extracted phone number
            $table->string('email', 100)->nullable();        // Extracted email
            
            // --- ADDRESS INFO ---
            $table->string('province', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('house_no', 50)->nullable();
            $table->string('barangay', 50)->nullable();
            $table->string('zone', 50)->nullable();
            
            // --- PROFILE & IDENTITY ---
            $table->string('profile_img', 255)->nullable();
            $table->string('qr_code', 255)->unique()->nullable();

            // --- AGRICULTURAL INFO ---
            $table->string('farmer_type', 50)->nullable();
            $table->string('farm_location', 255)->nullable();
            $table->string('land_size', 255)->nullable();
            $table->string('water_source', 255)->nullable();

            // --- SECONDARY CONTACT INFO ---
            $table->string('sc_fname', 50)->nullable();
            $table->string('sc_mname', 50)->nullable();
            $table->string('sc_lname', 50)->nullable();
            $table->string('sc_suffix', 50)->nullable();
            $table->string('sc_gender', 50)->nullable();
            
            // --- SECONDARY CONTACT ---
            $table->string('sc_contact_info', 100)->nullable(); // Raw input
            $table->string('sc_phone_no', 20)->nullable();      // Extracted phone
            $table->string('sc_email', 100)->nullable();        // Extracted email
            
            // --- SECONDARY ADDRESS ---
            $table->string('sc_province', 50)->nullable();
            $table->string('sc_city', 50)->nullable();
            $table->string('sc_house_no', 50)->nullable();
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