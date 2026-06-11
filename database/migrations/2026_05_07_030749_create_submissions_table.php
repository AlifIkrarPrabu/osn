<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignment_id')->constrained('assignments')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->text('content'); // Jawaban teks dari siswa
            $table->integer('score')->nullable(); // Nilai dari guru (0-100)
            $table->text('teacher_notes')->nullable(); // Feedback/Komentar guru
            $table->timestamp('submitted_at')->nullable(); // Waktu siswa mengumpul
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('submissions');
    }
};