<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\HistoriaController;
use App\Http\Controllers\PostagemController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\AdminController;

// Menu principal
Route::get('/', [HomeController::class, 'index'])->name('menu');

// Autenticação
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Tudo que requer usuário logado:
Route::middleware('auth')->group(function () {

    // Perfil → agora é menu de perfil
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');
    // Dentro da área de perfil:
    Route::get('/perfil/editar', [PerfilController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil/editar', [PerfilController::class, 'update'])->name('perfil.update');
    Route::post('/perfil/solicitar-criador', [PerfilController::class, 'solicitarCriador'])
         ->name('perfil.solicitar.criador');
    Route::post('/perfil/solicitar-admin', [PerfilController::class, 'solicitarAdmin'])
         ->name('perfil.solicitar.admin');

    // Histórias
    Route::get('/historias', [HistoriaController::class, 'index'])->name('historias.index');
    Route::get('/historias/{id}', [HistoriaController::class, 'show'])->name('historias.show');
    Route::post('/historias/{id}/avaliar', [AvaliacaoController::class, 'store'])->name('avaliacoes.store');

    // Gerenciar postagens
    Route::get('/gerenciar-postagens', [PostagemController::class, 'index'])->name('gerenciar.index');
    Route::get('/gerenciar-postagens/create', [PostagemController::class, 'create'])->name('gerenciar.create');
    Route::post('/gerenciar-postagens', [PostagemController::class, 'store'])->name('gerenciar.store');
    Route::get('/gerenciar-postagens/{id}/edit', [PostagemController::class, 'edit'])->name('gerenciar.edit');
    Route::put('/gerenciar-postagens/{id}', [PostagemController::class, 'update'])->name('gerenciar.update');
    Route::delete('/gerenciar-postagens/{id}', [PostagemController::class, 'destroy'])->name('gerenciar.destroy');

    // Administração (apenas admins)
    Route::middleware('tipo:admin')->group(function(){
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::post('/admin/aprovar-postagem/{id}', [AdminController::class, 'aprovarPostagem'])
             ->name('admin.aprovarPostagem');
        Route::post('/admin/devolver-postagem/{id}', [AdminController::class, 'devolverPostagem'])
             ->name('admin.devolverPostagem');
        Route::post('/admin/excluir-postagem/{id}', [AdminController::class, 'excluirPostagem'])
             ->name('admin.excluirPostagem');
        Route::post('/admin/aprovar-solicitacao/{id}', [AdminController::class, 'aprovarSolicitacao'])
             ->name('admin.aprovarSolicitacao');
        Route::post('/admin/negar-solicitacao/{id}', [AdminController::class, 'negarSolicitacao'])
             ->name('admin.negarSolicitacao');
    });

});
