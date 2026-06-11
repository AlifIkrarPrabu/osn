<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul Tugas
            $table->text('description'); // Instruksi Tugas
            $table->foreignId('classroom_id')->constrained('classrooms')->onDelete('cascade'); // Dikirim ke kelas mana
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade'); // Siapa guru pembuatnya
            $table->dateTime('deadline'); // Batas waktu pengumpulan
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('assignments');
    }
};