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
        Schema::create('anggota_kelompoks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kelompok')->constrained(
                table: 'kelompoks',
                indexName: 'id'
            );
            $table->foreignId('id_user')->constrained(
                table: 'users',
                indexName: 'id'
            );
            // $table->unsignedBigInteger('id_user');
            // $table->foreign('id_user')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_kelompoks');
    }
};
