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
        Schema::create('kelompok_pjbl', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mapel')->constrained(
                table: 'Mapels',
                indexName: 'id'
            );
            $table->foreignId('id_siklus_pjbl')->constrained(
                table: 'siklus_pjbls',
                indexName: 'id'
            );
            $table->foreignId('id_kelas')
                ->nullable()
                ->constrained('kelas')
                ->onDelete('set null');
            // $table->unsignedBigInteger('id_user');
            // $table->foreign('id_user')->references('id')->on('users');
            $table->string('paralel');
            $table->string('nama_kelompok_pjbl');
            $table->integer('jumlah_kelompok_pjbl');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelompok_pjbl');
    }
};
