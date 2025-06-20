<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('simulacao_times', function (Blueprint $table) {
            $table->id();

            $table->foreignId('simulacao_id')
                  ->constrained('simulacoes')
                  ->onDelete('cascade');

            $table->foreignId('time_id')
                  ->constrained('times')
                  ->onDelete('cascade');

            $table->string('nome_time')->nullable();
            $table->string('escudo_time')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('simulacao_times');
    }
};
