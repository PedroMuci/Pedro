<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','postagem_id','nota'
    ];

    public function postagem()
    {
        return $this->belongsTo(Postagem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
