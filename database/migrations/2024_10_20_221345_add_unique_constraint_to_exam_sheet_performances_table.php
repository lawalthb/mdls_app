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
        Schema::table('exam_sheet_performances', function (Blueprint $table) {
            // Add unique constraint on exam_sheet_id and subject_id
            $table->unique(['exam_sheet_id', 'subject_id'], 'unique_exam_performance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exam_sheet_performances', function (Blueprint $table) {
            // Drop the unique constraint if rolling back
            $table->dropUnique('unique_exam_performance');
        });
    }
};
