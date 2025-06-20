<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulacaoTime extends Model
{
    use HasFactory;

    protected $table = 'simulacao_times';

    protected $fillable = [
        'simulacao_id',
        'time_id',
        'nome_time',
        'escudo_time',
    ];

    public function simulacao()
    {
        return $this->belongsTo(Simulacao::class);
    }

    public function time()
    {
        return $this->belongsTo(Time::class);
    }
}
