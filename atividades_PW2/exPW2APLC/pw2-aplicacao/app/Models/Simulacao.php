<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simulacao extends Model
{
    use HasFactory;

    protected $table = 'simulacoes';

    protected $fillable = [
        'competicao_id',
        'nome_competicao',
        'icone_competicao',
        'tipo',
        'fase',
        'numero_times',
        'data_simulacao',
        'campeao_id',
    ];

    protected $casts = [
        'data_simulacao' => 'datetime',
        'numero_times'   => 'integer',
    ];

    public function competicao()
    {
        return $this->belongsTo(Competicao::class);
    }

    public function jogos()
    {
        return $this->hasMany(SimulacaoJogo::class);
    }

    public function campeao()
    {
        return $this->belongsTo(Time::class, 'campeao_id');
    }

    /** pivot “congelado” */
    public function simulacaoTimes()
    {
        return $this->hasMany(SimulacaoTime::class);
    }

    /** classificação da liga */
    public function simulacaoLigaTimes()
    {
        return $this->hasMany(SimulacaoLigaTime::class);
    }
}
