<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostagensTable extends Migration
{
    public function up(): void
    {
        Schema::create('postagens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('titulo');
            $table->text('texto');
            $table->string('imagem1')->nullable();
            $table->string('imagem2')->nullable();
            $table->string('imagem3')->nullable();
            $table->string('video')->nullable();
            $table->string('musica')->nullable();
            $table->string('fonte');
            $table->string('palavra_chave1')->nullable();
            $table->string('palavra_chave2')->nullable();
            $table->string('palavra_chave3')->nullable();
            $table->enum('status',['pendente','publicado','devolvido'])->default('pendente');
            $table->text('mensagem_devolucao')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('postagens');
    }
}
