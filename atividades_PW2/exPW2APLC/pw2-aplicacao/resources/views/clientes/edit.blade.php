@extends('layouts.app')

@section('content')
<h1>Editar Cliente</h1>

<form action="{{ route('clientes.update', $cliente) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="nome" class="form-control" value="{{ $cliente->nome }}" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ $cliente->email }}" required>
    </div>
    <div class="mb-3">
        <label>Telefone</label>
        <input type="text" name="telefone" class="form-control" value="{{ $cliente->telefone }}">
    </div>
    <button type="submit" class="btn btn-success">Atualizar</button>
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>
</form>
@endsection
