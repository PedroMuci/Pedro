@extends('layouts.app')

@section('title', 'Perfil')

@section('content')
    <h1>Editar Perfil</h1>

    @if(session('mensagem'))
        <p style="color: green;">{{ session('mensagem') }}</p>
    @endif

    <form action="{{ route('perfil.atualizar') }}" method="POST">
        @csrf
        <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Nome">
        <input type="date" name="data_nascimento" value="{{ old('data_nascimento', $user->data_nascimento) }}">
        <select name="tipo">
            <option value="leitor" {{ $user->tipo === 'leitor' ? 'selected' : '' }}>Leitor</option>
            <option value="autor" {{ $user->tipo === 'autor' ? 'selected' : '' }}>Autor</option>
            <option value="admin" {{ $user->tipo === 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
        <input type="submit" value="Atualizar">
    </form>
@endsection
