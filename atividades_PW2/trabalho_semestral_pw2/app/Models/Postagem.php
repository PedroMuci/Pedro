<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postagem extends Model
{
    use HasFactory;

 
    protected $table = 'postagens';

    protected $fillable = [
        'user_id','titulo','texto',
        'imagem1','imagem2','imagem3',
        'video','musica','fonte',
        'palavra_chave1','palavra_chave2','palavra_chave3',
        'status','mensagem_devolucao'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class);
    }
}
