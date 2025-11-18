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
    
            $table->foreignId('id_indikator')
                ->nullable()
                ->constrained('indikator_penilaians');
            // Relasi ke user (siswa/guru yang dinilai atau memberi nilai)
            $table->foreignId('id_user')->constrained(
                table: 'users',
                indexName: 'id'
            );

            $table->foreignId('id_kuis')
                ->nullable()
                ->constrained('kuis');


            // Nilai yang diberikan (1–5 atau sesuai skema)
            $table->integer('nilai');
            $table->string('file_jawaban')->nullable(); // untuk simpan path file PDF
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
