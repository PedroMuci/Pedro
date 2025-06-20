<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CompeticaoTime extends Pivot
{
    // Caso queira adicionar colunas extras depois, poderá incluir aqui
    public $timestamps = false;
}
