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
        Schema::create('pengumpulans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kelompok')->constrained(
                table: 'kelompoks',
                indexName: 'id'
            );
            $table->foreignId('id_pjbl')->constrained(
                table: 'pjbls',
                indexName: 'id'
            );
            $table->foreignId('id_user')->constrained(
                table: 'users',
                indexName: 'id'
            );
            $table->string('deskriptif')->nullable();
            $table->string('file_pengumpulan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumpulans');
    }
};
