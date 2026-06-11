<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('classroom_material', function (Blueprint $blade) {
            $blade->id();
            $blade->foreignId('classroom_id')->constrained()->onDelete('cascade');
            $blade->foreignId('material_id')->constrained()->onDelete('cascade');
            $blade->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('classroom_material');
    }
};