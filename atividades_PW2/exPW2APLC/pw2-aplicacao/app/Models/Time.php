<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_clube',
        'apelido_clube',
        'escudo',
        'ano_fundacao',
    ];

    public function getEscudoAttribute($value)
    {
        return $value ?? 'https://images.vexels.com/media/users/3/141726/isolated/preview/4482e9ed85031475608725c4cbc96405-escudo-heraldico-emty.png';
    }

    public function competicoes()
    {
        return $this->belongsToMany(Competicao::class)->using(CompeticaoTime::class);
    }
}