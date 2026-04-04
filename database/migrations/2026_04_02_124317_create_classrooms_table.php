<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('classrooms', function (Blueprint $blade) {
            $blade->id();
            $blade->string('name'); // Contoh: XI IPA 1
            $blade->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
            $blade->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('classrooms');
    }
};