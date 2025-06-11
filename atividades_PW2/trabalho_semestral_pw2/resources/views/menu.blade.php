@extends('layouts.app')

@section('content')

    <a href="{{ route('login.show') }}" class="login-btn">Login</a>


    <h1>Histórias Perdidas</h1>
    <p class="subtitle">
        Um site dedicado a compartilhar histórias interessantes
        e importantes que foram esquecidas ou ignoradas.
    </p>

  
    <div class="menu-buttons">
        <a href="{{ route('historias.index') }}">História</a>
        <a href="{{ route('gerenciar.index') }}">Gerenciar Postagens</a>
        <a href="{{ route('admin.index') }}">Administração</a>
    </div>
@endsection
