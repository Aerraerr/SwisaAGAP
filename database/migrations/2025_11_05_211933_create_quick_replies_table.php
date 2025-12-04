<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('quick_replies', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');
            $table->unsignedBigInteger('for_role_id')->nullable();
            $table->timestamps();

            // Foreign key reference to roles table
            $table->foreign('for_role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('set null');
        });

        // Insert default quick replies
        DB::table('quick_replies')->insert([
            // 🧑‍💼 Support Staff Quick Replies
            [
                'question' => 'How can I assist a member with registration?',
                'answer' => 'Guide the member to use the "Registration" tab and ensure all required documents are uploaded before submission.',
                'for_role_id' => 2, // Support Staff
            ],
            [
                'question' => 'What should I do if a user reports a technical issue?',
                'answer' => 'Log the issue in the support system and notify the admin if it remains unresolved after 24 hours.',
                'for_role_id' => 2, // Support Staff
            ],
            [
                'question' => 'How do I update a member’s account details?',
                'answer' => 'Access the admin dashboard and edit member information under "User Management."',
                'for_role_id' => 2, // Support Staff
            ],

            // 👤 Member Quick Replies
            [
                'question' => 'How do I update my profile?',
                'answer' => 'Go to your dashboard, select "Profile Settings," and edit your personal information as needed.',
                'for_role_id' => 1, // Member
            ],
            [
                'question' => 'How can I contact support?',
                'answer' => 'You can reach out to support staff via chat or through the "Help & Support" section in your dashboard.',
                'for_role_id' => 1, // Member
            ],
            [
                'question' => 'Where can I view my application status?',
                'answer' => 'Check your registration or request status under "My Requests" in your dashboard.',
                'for_role_id' => 1, // Member
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('quick_replies');
    }
};
