<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulacaoJogo extends Model
{
    use HasFactory;

    protected $table = 'simulacao_jogos';

    protected $fillable = [
        'simulacao_id',
        'time_a_id',
        'time_b_id',
        'gols_time_a',
        'gols_time_b',
        'fase',      
        'jogo',      
    ];

    public function simulacao()
    {
        return $this->belongsTo(Simulacao::class);
    }

  
  
    public function timeA()
    {
        return $this->belongsTo(SimulacaoTime::class, 'time_a_id');
    }

   
    public function timeB()
    {
        return $this->belongsTo(SimulacaoTime::class, 'time_b_id');
    }
}
