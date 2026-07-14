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
        Schema::create('log_siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained(
                table: 'siswas',
                indexName: 'log_siswa_id'
            )->cascadeOnDelete();
            $table->foreignId('kelas_id')->constrained(
                table: 'kelas',
                indexName: 'log_kelas_id'
            );
            $table->foreignId('tahun_id')->constrained(
                table: 'tahun_ajarans',
                indexName: 'log_tahun_id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_siswas');
    }
};
