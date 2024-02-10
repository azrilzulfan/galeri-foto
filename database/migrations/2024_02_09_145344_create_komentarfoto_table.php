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
        Schema::create('komentarfoto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('foto_id');
            $table->unsignedBigInteger('users_id');
            $table->text('isi_komentar');
            $table->timestamps();

            $table->foreign('foto_id')->references('id')->on('foto');
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentarfoto');
    }
};
