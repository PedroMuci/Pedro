<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\IMCController;
use App\Http\Controllers\SonoController;
use App\Http\Controllers\ViagemController;

Route::get('/', [SiteController::class, 'index'])->name('home');

Route::get('/imc', [IMCController::class, 'index'])->name('imc');
Route::post('/imc', [IMCController::class, 'calcular']);

Route::get('/sono', [SonoController::class, 'index'])->name('sono');
Route::post('/sono', [SonoController::class, 'avaliar']);

Route::get('/viagem', [ViagemController::class, 'index'])->name('viagem');
Route::post('/viagem', [ViagemController::class, 'calcular']);
