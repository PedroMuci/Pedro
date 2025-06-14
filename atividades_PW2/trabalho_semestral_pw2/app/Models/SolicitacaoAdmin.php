<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitacaoAdmin extends Model
{
    use HasFactory;


    protected $table = 'solicitacao_admins';

    protected $fillable = [
        'user_id',
        'status',
        'justificativa',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
