@extends('layouts.app')

@section('title', 'Menu Principal')

@section('content')
  <h1 class="menu-title">Bem-vindo ao Gerenciador de Competições</h1>
  <p class="menu-subtitle">Escolha uma das opções abaixo para começar.</p>

  <div class="grid-buttons">
    <a href="{{ route('competicoes.index') }}" class="action-card">
      <span style="font-size: 2.5rem;">🏆</span>
      Competições
    </a>

    <a href="{{ route('times.index') }}" class="action-card">
      <span style="font-size: 2.5rem;">⚽</span>
      Times
    </a>

    <a href="{{ route('simulacoes.index') }}" class="action-card">
      <span style="font-size: 2.5rem;">⚔️</span>
      Duelos
    </a>
  </div>
@endsection
