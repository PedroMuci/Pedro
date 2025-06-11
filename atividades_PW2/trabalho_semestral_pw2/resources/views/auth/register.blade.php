@extends('layouts.app')

@section('content')
<div style="width:320px; margin:50px auto;">
    <h2>Cadastro</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div style="margin-bottom:15px;">
            <input type="text" name="name" placeholder="Nome" required style="width:100%; padding:8px;">
        </div>
        <div style="margin-bottom:15px;">
            <input type="email" name="email" placeholder="Email" required style="width:100%; padding:8px;">
        </div>
        <div style="margin-bottom:15px;">
            <input type="password" name="password" placeholder="Senha" required style="width:100%; padding:8px;">
        </div>
        <div style="margin-bottom:15px;">
            <input type="password" name="password_confirmation" placeholder="Confirme a senha" required style="width:100%; padding:8px;">
        </div>
        <div style="margin-bottom:15px;">
            <input type="date" name="data_nascimento" placeholder="Data de Nascimento" style="width:100%; padding:8px;">
        </div>
        <button class="btn-acao" style="width:100%;">Cadastrar</button>
    </form>
</div>
@endsection
