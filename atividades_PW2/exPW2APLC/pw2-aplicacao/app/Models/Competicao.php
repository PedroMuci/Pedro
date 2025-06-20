<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competicao extends Model
{
    use HasFactory;

    protected $table = 'competicoes';


    protected $fillable = [
        'nome',
        'icone',
        'tipo',
        'data_criacao',
        'edicao',
    ];

    protected $dates = ['data_criacao'];

    public function times()
    {
        return $this->belongsToMany(Time::class)->using(CompeticaoTime::class);
    }

    public function simulacoes()
    {
        return $this->hasMany(Simulacao::class);
    }
}
