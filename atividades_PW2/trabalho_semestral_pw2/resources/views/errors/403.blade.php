@extends('layouts.app')

@section('title', 'Acesso Negado')

@section('content')
    <div style="text-align: center; margin-top: 100px;">
        <h1 style="font-size: 72px; color: #B71C1C;">403</h1>
        <h3 style="color: #D84315;">Você não tem permissão para acessar esta página.</h3>
        <a href="{{ route('menu') }}" class="btn-acao" style="margin-top: 20px;">Voltar ao Menu</a>
    </div>
@endsection
