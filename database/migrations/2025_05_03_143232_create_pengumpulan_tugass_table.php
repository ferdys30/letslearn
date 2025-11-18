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
        Schema::create('pengumpulan_tugass', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kelompok_pjbl')->constrained(
                table: 'kelompok_pjbl',
                indexName: 'id'
            );
            $table->foreignId('id_siklus_pjbl')->constrained(
                table: 'siklus_pjbls',
                indexName: 'id'
            );
            $table->foreignId('id_aktivitas_pjbl')->constrained(
                table: 'aktivitas_pjbls',
                indexName: 'id'
            );
            $table->foreignId('id_user')->constrained(
                table: 'users',
                indexName: 'id'
            );
            $table->string('deskriptif')->nullable();
            $table->string('file_pengumpulan_tugas')->nullable();
            $table->string('status')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumpulan_tugass');
    }
};
