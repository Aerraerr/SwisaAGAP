<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

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
            $table->foreignId('sector_id')->constrained('sectors')->onDelete('cascade');

            //USER INFO
            $table->string('fname', 50);
            $table->string('mname', 50)->nullable();
            $table->string('lname', 50);
            $table->enum('suffix', ['jr', 'sr'])->nullable();
            $table->date('birthdate');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('contact_no', 20);
            $table->string('province', 50);
            $table->string('city', 50);
            $table->string('barangay', 50);
            $table->string('zone', 50);
            $table->string('profile_img', 255)->nullable();

            //AGRI INFO
            $table->string('farm_location');
            $table->string('land_size');
            $table->string('water_source');

            //SECOND CONTACT INFO
            $table->string('sc_fname', 50);
            $table->string('sc_mname', 50)->nullable();
            $table->string('sc_lname', 50);
            $table->enum('sc_suffix', ['Jr', 'Sr', 'I', 'II', 'IV', 'V', 'None'])->nullable();
            $table->enum('sc_gender', ['Male', 'Female']);
            $table->string('sc_contact_no', 20);
            $table->string('sc_email', 20)->nullable();
            $table->string('sc_province', 50);
            $table->string('sc_city', 50);
            $table->string('sc_barangay', 50);
            $table->string('sc_zone', 50)->nullable();
            $table->enum('relationship', ['Parent', 'Sibling', 'Spouse', 'Child', 'Relative', 'Friend', 'Guardian', 'Other']);

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
