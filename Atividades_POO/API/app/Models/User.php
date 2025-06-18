<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users'; 
    protected $primaryKey = 'id'; 

    protected $fillable = [
        'name',
        'email',
        'data_nascimento',
        'tipo_conta',
    ];

    protected $hidden = [];

    // Relacionamentos
    public function postagens(): HasMany
    {
        return $this->hasMany(Postagem::class, 'user_id', 'id');
    }

    public function comentarios(): HasMany
    {
        return $this->hasMany(Comentario::class, 'user_id', 'id');
    }

    public function avaliacoes(): HasMany
    {
        return $this->hasMany(Avaliacao::class, 'user_id', 'id');
    }
}
