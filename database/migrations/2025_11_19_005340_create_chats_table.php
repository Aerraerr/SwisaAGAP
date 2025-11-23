<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();

            // User in the chat (nullable)
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            // Admin in the chat (nullable)
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('set null');

            // Support staff in the chat (nullable)
            $table->foreignId('support_staff_id')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
