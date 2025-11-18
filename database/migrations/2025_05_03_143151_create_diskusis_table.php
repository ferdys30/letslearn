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
        Schema::create('diskusis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kelompok_pjbl')->constrained(
                table: 'kelompok_pjbl',
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
            $table->foreignId('id_siklus_pjbl')->constrained(
                table: 'siklus_pjbls',
                indexName: 'id'
            );
            $table->integer('parent_id')->nullable();
            $table->string('pesan_diskusi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diskusis');
    }
};
