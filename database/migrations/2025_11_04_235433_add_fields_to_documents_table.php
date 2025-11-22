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
        Schema::table('documents', function (Blueprint $table) {
            // ✅ Add new fields if they don't exist
            if (!Schema::hasColumn('documents', 'file_type')) {
                $table->string('file_type')->nullable()->after('file_name');
            }
            if (!Schema::hasColumn('documents', 'file_size')) {
                $table->integer('file_size')->nullable()->after('file_type');
            }
            if (!Schema::hasColumn('documents', 'document_type')) {
                $table->string('document_type')->nullable()->after('file_size');
            }
            if (!Schema::hasColumn('documents', 'requirement_id')) {
                $table->unsignedBigInteger('requirement_id')->nullable()->after('document_type');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn(['file_type', 'file_size', 'document_type', 'requirement_id']);
        });
    }
};
