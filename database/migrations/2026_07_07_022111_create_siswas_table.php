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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug');
            $table->string('nis')->unique();
            $table->string('sekolah');
            $table->string('alamat')->nullable();
            $table->text('phone');
            $table->string('phone_hash', 64)->unique();
            $table->text('phone_ortu');
            $table->string('phone_ortu_hash', 64)->unique();
            $table->boolean('status')->default(true);
            $table->boolean('lulus')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
