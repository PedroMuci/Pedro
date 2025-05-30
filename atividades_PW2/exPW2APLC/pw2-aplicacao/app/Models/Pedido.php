<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = ['cliente_id', 'descricao', 'valor', 'data_pedido'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
