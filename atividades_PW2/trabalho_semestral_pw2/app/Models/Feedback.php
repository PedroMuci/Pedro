<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'postagem_id','admin_id','mensagem'
    ];

    public function postagem()
    {
        return $this->belongsTo(Postagem::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class,'admin_id');
    }
}
