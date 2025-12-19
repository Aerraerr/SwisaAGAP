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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();

            // Link to the user who did the action (if applicable)
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            // Store the user's full name (snapshot at the time of log)
            $table->string('user_name')->nullable();

            // Role at the time of the activity (Admin, Member, Officer, etc.)
            $table->string('role')->nullable();

            // Description of what they did (e.g., Logged In, Submitted Application)
            $table->text('activity')->nullable();

            // IP address of the user
            $table->string('ip_address', 45)->nullable();

            // ✅ Status column with default "success" to standardize log entries
            $table->enum('status', ['success', 'failed', 'pending'])->default('success');

            // Timestamp of when the activity happened (defaults to current time)
            $table->timestamp('activity_timestamp')->useCurrent();

            // Optional JSON column for more details (store error messages, payloads, etc.)
            $table->json('details')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
