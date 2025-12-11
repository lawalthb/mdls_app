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
        Schema::table('student_details', function (Blueprint $table) {
            $table->timestamp('last_promoted_at')->nullable()->after('class_id');
            $table->string('promotion_flag', 20)->default('old')->after('last_promoted_at')->comment('old = needs promotion, new = recently promoted');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_details', function (Blueprint $table) {
            $table->dropColumn(['last_promoted_at', 'promotion_flag']);
        });
    }
};
