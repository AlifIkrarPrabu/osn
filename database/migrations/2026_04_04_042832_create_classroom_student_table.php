<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('classroom_student', function (Blueprint $table) {
        $table->id();
        $table->foreignId('classroom_id')->constrained('classrooms')->onDelete('cascade');
        $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
        $table->timestamps();
    });
}

public function down() { Schema::dropIfExists('classroom_student'); }
};
