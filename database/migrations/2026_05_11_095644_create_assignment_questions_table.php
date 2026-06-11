<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
    Schema::create('assignment_questions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('assignment_id')->constrained('assignments')->onDelete('cascade');
        $table->text('question_text');
        $table->string('option_a');
        $table->string('option_b');
        $table->string('option_c');
        $table->string('option_d');
        $table->string('correct_answer'); // Menyimpan nilai 'a', 'b', 'c', atau 'd'
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_questions');
    }
};
