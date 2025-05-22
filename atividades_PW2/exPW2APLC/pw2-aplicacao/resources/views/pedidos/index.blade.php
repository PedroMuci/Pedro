@extends('layouts.app')

@section('content')
<h1>Pedidos</h1>
<a href="{{ route('pedidos.create') }}" class="btn btn-primary mb-3">Novo Pedido</a>

<form method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="filtro" class="form-control" placeholder="Buscar por descrição" value="{{ $filtro }}">
        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
    </div>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Descrição</th>
            <th>Valor</th>
            <th>Data</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pedidos as $pedido)
        <tr>
            <td>{{ $pedido->id }}</td>
            <td>{{ $pedido->cliente->nome }}</td>
            <td>{{ $pedido->descricao }}</td>
            <td>R$ {{ number_format($pedido->valor, 2, ',', '.') }}</td>
            <td>{{ \Carbon\Carbon::parse($pedido->data_pedido)->format('d/m/Y') }}</td>
            <td>
                <a href="{{ route('pedidos.edit', $pedido) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('pedidos.destroy', $pedido) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Deseja excluir?')">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
