<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_answers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id'); // user siswa
            $table->unsignedBigInteger('task_id');    // soal
            $table->text('answer');                   // jawaban siswa

            $table->timestamps();

            // foreign key (opsional tapi bagus)
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_answers');
    }
};
