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
        Schema::create('studi_kasus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mapel')->constrained(
                table: 'Mapels',
                indexName: 'id'
            );
            $table->foreignId('id_kelompok_pjbl')->constrained(
                table: 'kelompok_pjbl',
                indexName: 'id'
            );
            // $table->unsignedBigInteger('id_user');
            // $table->foreign('id_user')->references('id')->on('users');
            $table->string('studi_kasus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studi_kasus');
    }
};
