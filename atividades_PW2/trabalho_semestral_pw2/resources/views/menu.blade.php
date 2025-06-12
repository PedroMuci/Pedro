@extends('layouts.app')

@section('title', 'Histórias Perdidas')

@section('content')
    <h1>Histórias Perdidas</h1>
    <p class="subtitle">
        Um site dedicado a compartilhar histórias interessantes
        e importantes que foram esquecidas ou ignoradas.
    </p>

    <div class="menu-buttons">
        <a href="{{ route('historias.index') }}" class="btn-acao">Histórias</a>
        <a href="{{ route('gerenciar.index') }}" class="btn-acao">Gerenciar Postagens</a>
        <a href="{{ route('admin.index') }}" class="btn-acao">Administração</a>
    </div>
@endsection
