<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kosongkan karena tabel sudah dibuat manual di database.
     */
    public function up(): void
    {
        // Kosong
    }

    /**
     * Kosongkan agar tidak menghapus tabel yang sudah ada data pentingnya.
     */
    public function down(): void
    {
        // Kosong
    }
};