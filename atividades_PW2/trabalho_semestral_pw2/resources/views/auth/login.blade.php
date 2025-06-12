@extends('layouts.app')

@section('content')
<div style="width:320px; margin:80px auto; text-align:center;">
    <h2 style="margin-bottom:30px;">Login</h2>

    {{-- Exibir erro se login falhar --}}
    @if(session('erro_login'))
        <div style="color: red; margin-bottom: 20px;">
            {{ session('erro_login') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required autofocus>
        <input type="password" name="password" placeholder="Senha" required>
        <button type="submit" class="btn-acao" style="width:100%; margin-top:20px;">
            Entrar
        </button>
    </form>

    <p style="margin-top:20px;">
        <a href="{{ route('register') }}" style="color:#5D3A2E; text-decoration:none;">Cadastrar-se</a>
    </p>
</div>
@endsection
