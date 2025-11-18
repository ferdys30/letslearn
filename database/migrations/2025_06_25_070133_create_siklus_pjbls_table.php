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
        Schema::create('siklus_pjbls', function (Blueprint $table) {
            $table->id();

            // Relasi ke mata pelajaran
            $table->foreignId('id_mapel')->constrained(
                table: 'Mapels',
                indexName: 'id'
            );

            $table->string('nama_siklus_pjbl'); // Misalnya "aktivitas_pjbl 1 - Semester Ganjil"
            $table->string('slug'); // Misalnya "aktivitas_pjbl 1 - Semester Ganjil"
            $table->string('deskripsi')->nullable();

            // Tambahan opsional
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siklus_pjbls');
    }
};
