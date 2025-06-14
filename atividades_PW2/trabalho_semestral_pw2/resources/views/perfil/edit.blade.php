@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')
<div style="max-width:400px; margin:50px auto;">
    <h2 style="text-align:center;">Editar Perfil</h2>

    @if(session('mensagem'))
        <div style="background:#C8E6C9; padding:10px; margin-bottom:15px;">
            {{ session('mensagem') }}
        </div>
    @endif

    <form method="POST" action="{{ route('perfil.update') }}">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Nome" required>
        <input type="date" name="data_nascimento" value="{{ old('data_nascimento', $user->data_nascimento) }}">

            <button type="submit" class="btn-acao" style="width: 100%;">Salvar Alterações</button>
    </form>
    <div style="text-align:center; margin-top:30px;">
        <a href="{{ route('perfil') }}" class="btn-acao" style="
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
