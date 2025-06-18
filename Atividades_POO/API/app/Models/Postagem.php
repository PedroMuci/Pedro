<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postagem extends Model
{
    use HasFactory;

    protected $table = 'postagens';

    protected $fillable = [
        'titulo',
        'texto',
        'imagem1',
        'imagem2',
        'imagem3',
        'video',
        'musica',
        'fonte',
        'palavra_chave1',
        'palavra_chave2',
        'palavra_chave3',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
}
