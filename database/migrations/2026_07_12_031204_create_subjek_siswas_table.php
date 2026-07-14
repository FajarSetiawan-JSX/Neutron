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
        Schema::create('subjek_siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mapel_id')->constrained(
                table: 'mapels',
                indexName: 'subjeksiswa_mapel_id'
            )->cascadeOnDelete();
            $table->foreignId('siswa_id')->constrained(
                table: 'siswas',
                indexName: 'subjeksiswa_siswa_id'
            )->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjek_siswas');
    }
};
