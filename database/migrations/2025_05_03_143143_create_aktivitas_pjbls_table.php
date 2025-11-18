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
        Schema::create('aktivitas_pjbls', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan');
            $table->foreignId('id_mapel')->constrained(
                table: 'Mapels',
                indexName: 'id'
            );
            $table->foreignId('id_siklus_pjbl')
                ->nullable()
                ->constrained('siklus_pjbls')
                ->onDelete('cascade');
            $table->foreignId('id_pertemuan')
                ->nullable()
                ->constrained('pertemuans')
                ->onDelete('set null');
            // $table->unsignedBigInteger('id_user');
            // $table->foreign('id_user')->references('id')->on('users');
            $table->string('nama_syntax');
            $table->string('slug');
            $table->string('penjelasan');
            $table->integer('pengumpulan_tugas')->nullable();//type pengumpulan_tugas
            $table->integer('waktu')->nullable();;//type pengumpulan_tugas
            $table->dateTime('waktu_mulai');
            $table->integer('nilai_maks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktivitas_pjbls');
    }
};

