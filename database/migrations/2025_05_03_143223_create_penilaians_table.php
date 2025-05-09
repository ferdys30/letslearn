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
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
    
            // Relasi ke indikator penilaian
            $table->foreignId('id_indikator')->constrained(
                table: 'indikator_penilaians',
                indexName: 'id'
            );

            // Relasi ke user (siswa/guru yang dinilai atau memberi nilai)
            $table->foreignId('id_user')->constrained(
                table: 'users',
                indexName: 'id'
            );

            // Nilai yang diberikan (1–5 atau sesuai skema)
            $table->integer('nilai');

            // Optional: komentar atau catatan tambahan
            // $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
