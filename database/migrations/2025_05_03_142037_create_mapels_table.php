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
        Schema::create('Mapels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained(
                table: 'users',
                indexName: 'id'
            );
            $table->foreignId('id_kelas')->constrained(
                table: 'Kelas',
                indexName: 'id'
            );
            // $table->unsignedBigInteger('id_user');
            // $table->foreign('id_user')->references('id')->on('users');
            $table->string('nama_mapel');
            $table->string('slug');
            $table->string('deskripsi_mapel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Mapels');
    }
};
