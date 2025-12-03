<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->text('description')->nullable();
            
            // Foreign Key untuk menghubungkan Kursus dengan Guru (asumsi Guru adalah User)
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade'); 
            
            // Kolom yang digunakan dalam Query Controller Anda
            $table->boolean('is_active')->default(true)->comment('0=Inactive, 1=Active'); 

            // Kolom umum lainnya
            $table->string('status')->default('draft');
            $table->integer('credits')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};