<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitacaosAdmin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','status','justificativa'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
