// database/migrations/20250619171310_create_simulacao_liga_times_table.php

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('simulacao_liga_times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('simulacao_id')->constrained('simulacoes')->onDelete('cascade');
            $table->foreignId('time_id')->constrained('times')->onDelete('cascade');
            $table->unsignedInteger('pontos')->default(0);
            $table->unsignedInteger('gols_pro')->default(0);
            $table->unsignedInteger('gols_contra')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('simulacao_liga_times');
    }
};
