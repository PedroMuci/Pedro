@extends('layouts.app')

@section('content')
<div style="width:320px; margin:50px auto;">
    <h2>Cadastro</h2>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul style="padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div style="margin-bottom:15px;">
            <input type="text" name="name" placeholder="Nome" value="{{ old('name') }}" required style="width:100%; padding:8px;">
        </div>
        <div style="margin-bottom:15px;">
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required style="width:100%; padding:8px;">
        </div>
        <div style="margin-bottom:15px;">
            <input type="password" name="password" placeholder="Senha" required style="width:100%; padding:8px;">
        </div>
        <div style="margin-bottom:15px;">
            <input type="password" name="password_confirmation" placeholder="Confirme a senha" required style="width:100%; padding:8px;">
        </div>
        <div style="margin-bottom:15px;">
            <input type="date" name="data_nascimento" placeholder="Data de Nascimento" value="{{ old('data_nascimento') }}" style="width:100%; padding:8px;">
        </div>
        <button class="btn-acao" style="width:100%;">Cadastrar</button>
    </form>

    <div style="text-align:center; margin-top:30px;">
        <a href="{{ route('login') }}" class="btn-acao" style="
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 999;">
            ← Voltar
        </a>
    </div>
</div>
@endsection
