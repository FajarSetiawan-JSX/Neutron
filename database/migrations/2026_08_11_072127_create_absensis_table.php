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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pertemuan_id')->constrained(
                table: 'pertemuans',
                indexName: 'absensis_pertemuan_id'
            );
            $table->foreignId('rombel_siswa_id')->constrained(
                table: 'rombel_siswas',
                indexName: 'absensis_siswa_id'
            )->cascadeOnDelete();
            $table->boolean('kehadiran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
