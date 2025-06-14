<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\HistoriaController;
use App\Http\Controllers\PostagemController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;

Route::get('/', [HomeController::class, 'index'])->name('menu');

Route::get('/login',    [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login',   [AuthController::class, 'login'])->name('login');
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register',[AuthController::class, 'register'])->name('register');

Route::middleware('auth')->group(function () {

    Route::get('/perfil',        [PerfilController::class, 'index'])->name('perfil');
    Route::get('/perfil/editar', [PerfilController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil/editar', [PerfilController::class, 'update'])->name('perfil.update');
    Route::post('/perfil/solicitar-criador', [PerfilController::class, 'solicitarCriador'])->name('perfil.solicitar.criador');
    Route::post('/perfil/solicitar-admin',   [PerfilController::class, 'solicitarAdmin'])->name('perfil.solicitar.admin');

    Route::get('/historias',          [HistoriaController::class, 'index'])->name('historias.index');
    Route::get('/historias/{id}',     [HistoriaController::class, 'show'])->name('historias.show');
    Route::post('/historias/{id}/avaliar', [AvaliacaoController::class, 'store'])->name('avaliacoes.store');

    Route::get('/gerenciar-postagens', function () {
        if (Auth::user()->tipo_conta !== 'leitor') {
            return app(PostagemController::class)->index();
        }
        abort(403);
    })->name('gerenciar.index');

    Route::get('/gerenciar-postagens/create',    [PostagemController::class, 'create'])->name('gerenciar.create');
    Route::post('/gerenciar-postagens',          [PostagemController::class, 'store'])->name('gerenciar.store');
    Route::get('/gerenciar-postagens/{id}/edit', [PostagemController::class, 'edit'])->name('gerenciar.edit');
    Route::put('/gerenciar-postagens/{id}',      [PostagemController::class, 'update'])->name('gerenciar.update');
    Route::delete('/gerenciar-postagens/{id}',   [PostagemController::class, 'destroy'])->name('gerenciar.destroy');

    Route::get('/admin', function () {
        if (Auth::user()->tipo_conta === 'admin') {
            return app(AdminController::class)->index();
        }
        abort(403);
    })->name('admin.index');

    Route::post('/admin/aprovar-postagem/{id}',   [AdminController::class, 'aprovarPostagem'])->name('admin.aprovarPostagem');
    Route::get('/admin/editar-postagem/{id}',     [PostagemController::class, 'edit'])->name('admin.editarPostagem');
    Route::post('/admin/excluir-postagem/{id}',   [AdminController::class, 'excluirPostagem'])->name('admin.excluirPostagem');
    Route::post('/admin/aprovar-solicitacao/{id}', [AdminController::class, 'aprovarSolicitacao'])->name('admin.aprovarSolicitacao');
    Route::post('/admin/negar-solicitacao/{id}',   [AdminController::class, 'negarSolicitacao'])->name('admin.negarSolicitacao');


    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::delete('/admin/dashboard/delete-usuario/{id}',     [DashboardController::class, 'deleteUser'])->name('admin.dashboard.deleteUsuario');
    Route::delete('/admin/dashboard/delete-postagem/{id}',    [DashboardController::class, 'deletePost'])->name('admin.dashboard.deletePostagem');
    Route::delete('/admin/dashboard/delete-avaliacao/{id}',   [DashboardController::class, 'deleteReview'])->name('admin.dashboard.deleteAvaliacao');
    
    Route::delete('/admin/dashboard/delete-all-usuarios',     [DashboardController::class, 'deleteAllUsers'])->name('admin.dashboard.deleteAllUsuarios');
    Route::delete('/admin/dashboard/delete-all-postagens',    [DashboardController::class, 'deleteAllPosts'])->name('admin.dashboard.deleteAllPostagens');
    Route::delete('/admin/dashboard/delete-all-avaliacoes',   [DashboardController::class, 'deleteAllReviews'])->name('admin.dashboard.deleteAllAvaliacoes');

});
