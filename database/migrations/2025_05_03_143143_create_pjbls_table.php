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
        Schema::create('pjbls', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan');
            $table->foreignId('id_mapel')->constrained(
                table: 'mata_pelajarans',
                indexName: 'id'
            );
            $table->foreignId('id_penugasan')
                ->nullable()
                ->constrained('penugasans')
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
            $table->integer('pengumpulan')->nullable();//type pengumpulan
            $table->integer('waktu')->nullable();;//type pengumpulan
            $table->dateTime('waktu_mulai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pjbls');
    }
};

