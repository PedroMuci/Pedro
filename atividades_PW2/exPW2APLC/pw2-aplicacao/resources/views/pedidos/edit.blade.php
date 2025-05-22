@extends('layouts.app')

@section('content')
<h1>Editar Pedido</h1>

<form action="{{ route('pedidos.update', $pedido) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Cliente</label>
        <select name="cliente_id" class="form-control" required>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}" {{ $cliente->id == $pedido->cliente_id ? 'selected' : '' }}>
                    {{ $cliente->nome }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Descrição</label>
        <input type="text" name="descricao" class="form-control" value="{{ $pedido->descricao }}" required>
    </div>
    <div class="mb-3">
        <label>Valor</label>
        <input type="number" step="0.01" name="valor" class="form-control" value="{{ $pedido->valor }}" required>
    </div>
    <div class="mb-3">
        <label>Data do Pedido</label>
        <input type="date" name="data_pedido" class="form-control" value="{{ $pedido->data_pedido }}" required>
    </div>
    <button type="submit" class="btn btn-success">Atualizar</button>
    <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Voltar</a>
</form>
@endsection
