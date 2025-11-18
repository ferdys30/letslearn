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
            $table->foreignId('id_siklus_pjbl')->constrained('siklus_pjbls')->onDelete('cascade');
            $table->foreignId('id_aktivitas_pjbl')->constrained('aktivitas_pjbls')->onDelete('cascade');
            $table->foreignId('id_anggota_kelompok')->constrained('anggota_kelompok')->onDelete('cascade');
            $table->string('judul')->nullable();
            $table->text('deskripsi')->nullable();
            $table->date('deadline')->nullable();
            $table->integer('status')->nullable();
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
