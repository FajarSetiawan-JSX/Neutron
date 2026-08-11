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
        Schema::create('rombels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->foreignId('tingkat_id')->constrained(
                table: 'tingkats',
                indexName: 'tingkats_rombel_id'
            );
            $table->foreignId('subjek_id')->constrained(
                table: 'subjek_tentors',
                indexName: 'subjeks_rombel_id'
            );
            $table->foreignId('tahun_id')->constrained(
                table: 'tahun_ajarans',
                indexName: 'tahuns_rombel_id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rombels');
    }
};
