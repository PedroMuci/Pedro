<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name','email','password','tipo_conta','data_nascimento','solicitacao_admin'
    ];

    protected $hidden = [
        'password','remember_token',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];

    public function postagens()
    {
        return $this->hasMany(Postagem::class);
    }

    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class,'admin_id');
    }

    public function solicitacaoAdmin()
    {
        return $this->hasOne(SolicitacaoAdmin::class);
    }
}
