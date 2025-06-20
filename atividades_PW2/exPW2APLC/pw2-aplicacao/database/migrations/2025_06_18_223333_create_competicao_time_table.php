<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('competicao_time', function (Blueprint $table) {
            $table->foreignId('competicao_id')->constrained('competicoes')->onDelete('cascade');
            $table->foreignId('time_id')->constrained('times')->onDelete('cascade');
            $table->primary(['competicao_id', 'time_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('competicao_time');
    }
};
