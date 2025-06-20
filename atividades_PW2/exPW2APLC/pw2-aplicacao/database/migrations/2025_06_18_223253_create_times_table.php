<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('times', function (Blueprint $table) {
            $table->id();
            $table->string('nome_clube');
            $table->string('apelido_clube')->nullable();
            $table->string('escudo')->nullable(); 
            $table->year('ano_fundacao');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('times');
    }
};