<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostagemController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\ComentarioController;

// Rota raiz redireciona para /menu
Route::get('/', function () {
    return redirect()->route('menu');
});

// Rota para a view do menu
Route::get('/menu', function () {
    return view('menu');
})->name('menu');

// Rotas de Usuário
Route::resource('users', UserController::class);

// Rotas de Postagem
Route::resource('postagens', PostagemController::class);

// Rotas de Avaliação
Route::resource('avaliacoes', AvaliacaoController::class);

// Rotas de Comentário
Route::resource('comentarios', ComentarioController::class);
