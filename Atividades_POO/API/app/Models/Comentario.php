<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'conteudo',
        'user_id',
        'postagem_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function postagem()
    {
        return $this->belongsTo(Postagem::class);
    }
}
