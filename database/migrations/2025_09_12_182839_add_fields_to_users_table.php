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
        Schema::table('users', function (Blueprint $table) {
            $table->string('fname', 50)->nullable()->after('id');
            $table->string('mname', 50)->nullable()->after('fname');
            $table->string('lname', 50)->nullable()->after('mname');
            $table->string('suffix', 5)->nullable()->after('lname');
            $table->date('birthdate')->nullable()->after('email');
            $table->enum('gender', ['Male', 'Female'])->nullable()->after('birthdate');
            $table->string('contact_no', 20)->nullable()->after('gender');
            $table->string('province', 50)->nullable()->after('contact_no');
            $table->string('city', 50)->nullable()->after('province');
            $table->string('barangay', 50)->nullable()->after('city');
            $table->string('zone', 50)->nullable()->after('barangay');
            $table->string('profile_img', 255)->nullable()->after('zone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'fname', 'mname', 'lname', 'suffix',
                'birthdate', 'gender',
                'contact_no', 'province', 'city', 'barangay', 'zone',
                'profile_img',
            ]);
        });
    }
};
