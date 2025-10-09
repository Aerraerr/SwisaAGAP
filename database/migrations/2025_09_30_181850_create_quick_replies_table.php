<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('quick_replies', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('answer');
            $table->timestamps();
        });

        // Insert default quick replies
        DB::table('quick_replies')->insert([
            ['question' => 'How do I register?', 'answer' => 'You can register through your dashboard under the "Registration" tab.'],
            ['question' => 'What are the requirements?', 'answer' => 'You need to be a registered member and provide valid documents.'],
            ['question' => 'How long does approval take?', 'answer' => 'The approval process usually takes 3–5 business days.'],
            ['question' => 'Who can I contact for help?', 'answer' => 'You can contact our support team via email or this chat.'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('quick_replies');
    }
};
