@extends('layouts.app')

@section('content')
<h1>Novo Pedido</h1>

<form action="{{ route('pedidos.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Cliente</label>
        <select name="cliente_id" class="form-control" required>
            <option value="">Selecione</option>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Descrição</label>
        <input type="text" name="descricao" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Valor</label>
        <input type="number" step="0.01" name="valor" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Data do Pedido</label>
        <input type="date" name="data_pedido" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Voltar</a>
</form>
@endsection
