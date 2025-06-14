@extends('layouts.app')

@section('title', 'Meu Perfil')

@section('content')
<div style="max-width:400px; margin:50px auto; text-align:center;">
    <h2 style="color:#3E2723; margin-bottom:10px;">Olá, {{ $user->name }}</h2>
    <p style="color:#5D4037; margin-bottom:20px;">
        <strong>Tipo de conta:</strong> {{ ucfirst($user->tipo_conta) }}
    </p>

    @if($pendente)
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

        @if($user->tipo_conta !== 'admin' && !$pendente)
            <form method="POST" action="{{ route('perfil.solicitar.admin') }}" style="margin:0; width: 200px;">
                @csrf
                <button type="submit" class="btn-acao" style="width: 100%;">Solicitar Admin</button>
            </form>
        @endif

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}" style="margin:0; width: 200px;">
            @csrf
            <button type="submit" class="btn-acao" style="width: 100%;">Sair</button>
        </form>
    </div>
    <div style="text-align:center; margin-top:30px;">
        <a href="{{ route('menu') }}" class="btn-acao" style="
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 999;"
        >
            ← Voltar
        </a>
    </div>
</div>
@endsection
