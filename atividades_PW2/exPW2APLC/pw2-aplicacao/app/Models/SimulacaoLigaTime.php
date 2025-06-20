<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulacaoLigaTime extends Model
{
    use HasFactory;

    protected $table = 'simulacao_liga_times';

    protected $fillable = [
        'simulacao_id',
        'time_id',
        'pontos',
        'gols_pro',
        'gols_contra',
    ];

    protected $casts = [
        'pontos'       => 'integer',
        'gols_pro'     => 'integer',
        'gols_contra'  => 'integer',
    ];

    public function simulacao()
    {
        return $this->belongsTo(Simulacao::class);
    }

    public function time()
    {
        return $this->belongsTo(Time::class);
    }

    public function getSaldoGolsAttribute(): int
    {
        return $this->gols_pro - $this->gols_contra;
    }
}
