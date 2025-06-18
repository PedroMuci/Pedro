<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('postagem_id')->constrained('postagens')->onDelete('cascade');
            $table->text('conteudo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
