<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('postagens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('titulo');
            $table->text('texto');
            $table->string('imagem1')->nullable();
            $table->string('imagem2')->nullable();
            $table->string('imagem3')->nullable();
            $table->string('video')->nullable();
            $table->string('musica')->nullable();
            $table->string('fonte')->nullable();
            $table->string('palavra_chave1')->nullable();
            $table->string('palavra_chave2')->nullable();
            $table->string('palavra_chave3')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('postagens');
    }
};
