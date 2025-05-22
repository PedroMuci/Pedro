@extends('layouts.app')

@section('title','Editar Pedido')

@section('content')
  <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 max-w-lg mx-auto">
    <h2 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100">
      Editar Pedido
    </h2>

    <form action="{{ route('pedidos.update', $pedido) }}" method="POST" class="space-y-5">
      @csrf @method('PUT')

      <div>
        <label class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
          Cliente
        </label>
        <select name="cliente_id" required
                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700">
          @foreach($clientes as $c)
            <option value="{{ $c->id }}" {{ $c->id == $pedido->cliente_id ? 'selected' : '' }} class="text-gray-900 dark:text-gray-100">
              {{ $c->nome }}
            </option>
          @endforeach
        </select>
      </div>

      <div>
        <label class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
          Descrição
        </label>
        <input type="text" name="descricao" value="{{ $pedido->descricao }}" required
               class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700"
               placeholder="Descrição do pedido">
      </div>

      <div>
        <label class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
          Valor
        </label>
        <input type="number" step="0.01" name="valor" value="{{ $pedido->valor }}" required
               class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700"
               placeholder="Valor em R$">
      </div>

      <div class="flex justify-between">
        <a href="{{ route('pedidos.index') }}"
           class="px-5 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-xl shadow-md hover:shadow-lg transition font-semibold">
          Cancelar
        </a>
        <button type="submit"
                class="px-5 py-2 bg-green-600 hover:bg-green-700 text-white rounded-xl shadow-md hover:shadow-lg transition font-semibold">
          Atualizar
        </button>
      </div>
    </form>
  </div>
@endsection