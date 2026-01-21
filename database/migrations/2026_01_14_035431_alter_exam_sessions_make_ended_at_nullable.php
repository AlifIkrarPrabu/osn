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
        Schema::table('exam_sessions', function (Blueprint $table) {
            // Ubah ended_at menjadi nullable
            $table->timestamp('ended_at')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exam_sessions', function (Blueprint $table) {
            // Kembalikan ended_at menjadi NOT NULL
            $table->timestamp('ended_at')->nullable(false)->change();
        });
    }
};
