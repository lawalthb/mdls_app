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
        Schema::table('exam_sheets', function (Blueprint $table) {
            // Add unique constraint on user_id, session_id, term_id, class_id
            $table->unique(['user_id', 'session_id', 'term_id', 'class_id'], 'unique_exam_sheet');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exam_sheets', function (Blueprint $table) {
            // Drop the unique constraint if rolling back
            $table->dropUnique('unique_exam_sheet');
        });
    }
};
