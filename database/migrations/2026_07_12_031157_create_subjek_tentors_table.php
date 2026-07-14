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
        Schema::create('subjek_tentors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tentor_id')->constrained(
                table: 'users',
                indexName: 'subjektentor_user_id'
            )->cascadeOnDelete();
            $table->foreignId('mapel_id')->constrained(
                table: 'mapels',
                indexName: 'subjektentor_mapel_id'
            )->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjek_tentors');
    }
};
