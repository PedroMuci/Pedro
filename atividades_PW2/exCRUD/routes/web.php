<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoContatoController;

// Redireciona a raiz diretamente para o CRUD
Route::redirect('/', '/tipocontato');

// Rotas do CRUD
Route::resource('tipocontato', TipoContatoController::class);