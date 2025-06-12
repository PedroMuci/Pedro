@extends('layouts.app')

@section('title', 'Meu Perfil')

@section('content')
<div style="max-width:400px; margin:50px auto; text-align:center;">
    <h2 style="color:#3E2723; margin-bottom:10px;">Olá, {{ $user->name }}</h2>
    <p style="color:#5D4037; margin-bottom:20px;">
        <strong>Tipo de conta:</strong> {{ ucfirst($user->tipo_conta) }}
    </p>

    @if($user->solicitacao_admin)
        <p style="color: #A33617; margin-bottom:20px;">Solicitação de admin pendente</p>
    @endif

    <div class="menu-buttons" style="width:100%; margin-top:30px; display:flex; flex-direction:column; gap:12px; align-items:center;">
        <a href="{{ route('perfil.edit') }}" class="btn-acao" style="width: 200px;">Editar Perfil</a>

        @if($user->tipo_conta !== 'criador')
            <form method="POST" action="{{ route('perfil.solicitar.criador') }}" style="margin:0; width: 200px;">
                @csrf
                <button type="submit" class="btn-acao" style="width: 100%;">Solicitar Criador</button>
            </form>
        @endif

        @if($user->tipo_conta !== 'admin' && !$user->solicitacao_admin)
            <form method="POST" action="{{ route('perfil.solicitar.admin') }}" style="margin:0; width: 200px;">
                @csrf
                <button type="submit" class="btn-acao" style="width: 100%;">Solicitar Admin</button>
            </form>
        @endif

        {{-- Botão de logout --}}
        <form method="POST" action="{{ route('logout') }}" style="margin:0; width: 200px;">
            @csrf
            <button type="submit" class="btn-acao" style="width: 100%;">Sair</button>
        </form>
    </div>
</div>
@endsection
