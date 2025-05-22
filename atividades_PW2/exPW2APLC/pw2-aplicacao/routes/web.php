<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;

Route::get('/', function () {
    return redirect()->route('login');  // Vai direto para login
});

require __DIR__.'/auth.php'; // Rotas do Breeze (login, register, logout)

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('clientes', ClienteController::class);
    Route::resource('pedidos', PedidoController::class);
});
