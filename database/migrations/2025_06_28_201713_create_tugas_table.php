<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penugasan')->constrained('penugasans')->onDelete('cascade');
            $table->foreignId('id_pjbl')->constrained('pjbls')->onDelete('cascade');
            $table->foreignId('id_anggota_kelompok')->constrained('anggota_kelompoks')->onDelete('cascade');
            $table->string('judul');
            $table->text('deskripsi');
            $table->date('deadline');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};
