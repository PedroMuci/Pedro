<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;

Route::get('/', function () {
    return redirect()->route('clientes.index');
});

Route::resource('clientes', ClienteController::class);
Route::resource('pedidos', PedidoController::class);
