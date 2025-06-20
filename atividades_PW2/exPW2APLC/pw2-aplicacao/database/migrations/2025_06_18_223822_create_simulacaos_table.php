<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('simulacoes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('competicao_id')
                  ->constrained('competicoes')
                  ->onDelete('cascade');

            $table->string('nome_competicao');    
            $table->string('icone_competicao');  

            $table->enum('tipo', ['liga', 'copa'])->index();
            $table->string('fase')->nullable()->index();

            $table->integer('numero_times')->default(0);

            $table->dateTime('data_simulacao');

            $table->foreignId('campeao_id')
                  ->nullable()
                  ->constrained('times')
                  ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('simulacoes');
    }
};
