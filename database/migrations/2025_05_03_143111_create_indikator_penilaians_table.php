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
        Schema::create('indikator_penilaians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mapel')->constrained(
                table: 'Mapels',
                indexName: 'id'
            );
            $table->foreignId('id_siklus_pjbl')->constrained(
                table: 'siklus_pjbls',
                indexName: 'id'
            );
            // $table->foreignId('id_posisi')->constrained(
            //     table: 'Posisis',
            //     indexName: 'id'
            // );
            // $table->unsignedBigInteger('id_user');
            // $table->foreign('id_user')->references('id')->on('users');
            $table->string('indikator_penilaian');
            $table->integer('skema');
            $table->string('nilai_maks');
            $table->string('skala_1');
            $table->string('skala_2');
            $table->string('skala_3');
            $table->string('skala_4');
            // $table->string('skala_5');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indikator_penilaians');
    }
};
