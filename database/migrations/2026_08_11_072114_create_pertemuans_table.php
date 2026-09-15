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
        Schema::create('pertemuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rombel_id')->constrained(
                table: 'rombels',
                indexName: 'pertemuan_rombel_id'
            )->cascadeOnDelete();
            $table->foreignId('tipe_id')->constrained(
                table: 'tipes',
                indexName: 'pertemuan_tipe_id'
            )->cascadeOnDelete();
            $table->integer('pertemuan');
            $table->string('materi');
            $table->boolean('selesai')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertemuans');
    }
};
