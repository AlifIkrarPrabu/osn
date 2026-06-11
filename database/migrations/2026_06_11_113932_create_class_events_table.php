<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('class_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classroom_id')->constrained('classrooms')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Guru pembuat
            $table->string('title'); // Nama agenda (misal: Ulangan Harian)
            $table->date('event_date'); // Tanggal agenda dilaksanakan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_events');
    }
};