@extends('layouts.app')

@section('title','Novo Pedido')

@section('content')
  <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 max-w-lg mx-auto">
    <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Novo Pedido</h2>

    <form action="{{ route('pedidos.store') }}" method="POST" class="space-y-4">
      @csrf
      
      <div>
        <label class="block mb-1 text-gray-700 dark:text-gray-300">Cliente *</label>
        <select name="cliente_id" required
                class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-green-500 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700">
          <option value="">Selecione um cliente</option>
          @foreach($clientes as $c)
            <option value="{{ $c->id }}" {{ old('cliente_id') == $c->id ? 'selected' : '' }}>
              {{ $c->nome }}
            </option>
          @endforeach
        </select>
      </div>

      <div>
        <label class="block mb-1 text-gray-700 dark:text-gray-300">Descrição *</label>
        <input type="text" name="descricao" value="{{ old('descricao') }}" required
               class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-green-500 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700"
               placeholder="Descrição do pedido">
      </div>

      <div>
        <label class="block mb-1 text-gray-700 dark:text-gray-300">Valor *</label>
        <input type="number" step="0.01" name="valor" value="{{ old('valor') }}" required
               class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-green-500 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700"
               placeholder="Valor em R$">
      </div>

      <div>
        <label class="block mb-1 text-gray-700 dark:text-gray-300">Data do Pedido *</label>
        <input type="date" name="data_pedido" value="{{ old('data_pedido', now()->format('Y-m-d')) }}" required
               class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-green-500 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700">
      </div>

      <div class="flex justify-between">
        <a href="{{ route('pedidos.index') }}"
           class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded transition">
          Cancelar
        </a>
        <button type="submit"
                class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded transition">
          Salvar
        </button>
      </div>
    </form>
  </div>
@endsection