@extends('layouts.app')

@section('title', 'Meu Perfil')

@section('content')
<div style="max-width:400px; margin:50px auto; text-align:center;">
    <h2>Olá, {{ $user->name }}</h2>
    <p><strong>Tipo de conta:</strong> {{ ucfirst($user->tipo_conta) }}</p>
    @if($user->solicitacao_admin)
        <p style="color: #A33617;">Solicitação de admin pendente</p>
    @endif

    <div class="menu-buttons" style="width:100%; margin-top:30px;">
        <a href="{{ route('perfil.edit') }}">Editar Perfil</a>
        @if($user->tipo_conta !== 'criador')
            <form method="POST" action="{{ route('perfil.solicitar.criador') }}">
                @csrf
                <button type="submit">Solicitar Criador</button>
            </form>
        @endif
        @if($user->tipo_conta !== 'admin' && !$user->solicitacao_admin)
            <form method="POST" action="{{ route('perfil.solicitar.admin') }}">
                @csrf
                <button type="submit">Solicitar Admin</button>
            </form>
        @endif
    </div>
</div>
@endsection
