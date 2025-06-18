<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    use HasFactory;

    protected $table = 'avaliacoes';

    protected $fillable = [
        'nota',
        'comentario',
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


