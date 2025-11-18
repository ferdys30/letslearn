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
        Schema::create('posisis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mapel')->constrained(
                table: 'Mapels',
                indexName: 'id'
            );
            $table->foreignId('id_siklus_pjbl')->constrained(
                table: 'siklus_pjbls',
                indexName: 'id'
            );
            $table->string('nama_posisi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posisis');
    }
};
