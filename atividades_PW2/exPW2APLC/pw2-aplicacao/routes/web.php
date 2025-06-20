<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompeticaoController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\SimulacaoController;


Route::get('/', fn() => redirect()->route('menu'));

require __DIR__.'/auth.php'; 

Route::middleware(['auth'])->group(function () {

    Route::get('/menu', fn() => view('menu'))->name('menu');

    Route::resource('competicoes', CompeticaoController::class)
        ->parameters(['competicoes' => 'competicao']);

    Route::resource('times', TimeController::class);

    Route::resource('simulacoes', SimulacaoController::class)
        ->parameters(['simulacoes' => 'simulacao']);
        
});
