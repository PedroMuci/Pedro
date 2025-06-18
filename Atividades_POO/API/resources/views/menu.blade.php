@extends('layouts.app')

@section('content')
    <h1>Bem-vindo ao Painel Administrativo</h1>
    <p class="subtitle">Escolha uma das opções abaixo para gerenciar os dados do sistema.</p>

    <div class="grid-buttons">
        <a href="{{ route('users.index') }}" class="action-card">
            <img src="{{ asset('images/icones/9131478.png') }}" alt="Ícone Usuários">
            Gerenciar Usuários
        </a>

        <a href="{{ route('postagens.index') }}" class="action-card">
            <img src="{{ asset('images/icones/6301160.png') }}" alt="Ícone Postagens">
            Gerenciar Postagens
        </a>

        <a href="{{ route('avaliacoes.index') }}" class="action-card">
            <img src="{{ asset('images/icones/6595788.png') }}" alt="Ícone Avaliações">
            Gerenciar Avaliações
        </a>

        <a href="{{ route('comentarios.index') }}" class="action-card">
            <img src="{{ asset('images/icones/9374926.png') }}" alt="Ícone Comentários">
            Gerenciar Comentários
        </a>
    </div>
@endsection
