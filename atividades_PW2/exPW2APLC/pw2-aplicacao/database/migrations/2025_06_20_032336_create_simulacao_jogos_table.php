<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('simulacao_jogos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('simulacao_id')->constrained('simulacoes')->onDelete('cascade');
            $table->foreignId('time_a_id')->constrained('times')->onDelete('cascade');
            $table->foreignId('time_b_id')->constrained('times')->onDelete('cascade');
            $table->unsignedTinyInteger('gols_time_a');
            $table->unsignedTinyInteger('gols_time_b');
            $table->string('fase')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('simulacao_jogos');
    }
};
