@extends('layouts.app')

@section('title','Pedidos')

@section('content')
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Pedidos</h2>
    <a href="{{ route('pedidos.create') }}"
       class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-xl shadow-md hover:shadow-lg transition font-semibold">
      + Novo Pedido
    </a>
  </div>

  <form method="GET" action="{{ route('pedidos.index') }}" class="mb-6">
    <input type="text" name="filtro" value="{{ request('filtro') }}"
           placeholder="Buscar por descrição"
           class="w-full md:w-1/3 px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 text-gray-900 dark:text-gray-900 placeholder-gray-500">
  </form>

  <div class="overflow-x-auto">
    <table class="min-w-full bg-white dark:bg-gray-800 rounded-xl shadow divide-y divide-gray-200 dark:divide-gray-700">
      <thead class="bg-gray-50 dark:bg-gray-700">
      <tr>
        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-gray-600 dark:text-gray-300">ID</th>
        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-gray-600 dark:text-gray-300">Cliente</th>
        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-gray-600 dark:text-gray-300">Descrição</th>
        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-gray-600 dark:text-gray-300">Valor</th>
        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-gray-600 dark:text-gray-300">Data</th>
        <th class="px-6 py-3 text-center text-xs font-bold uppercase text-gray-600 dark:text-gray-300">Ações</th>
      </tr>
      </thead>
      <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
      @foreach($pedidos as $p)
        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
          <td class="px-6 py-4">{{ $p->id }}</td>
          <td class="px-6 py-4">{{ $p->cliente->nome }}</td>
          <td class="px-6 py-4">{{ $p->descricao }}</td>
          <td class="px-6 py-4">R$ {{ number_format($p->valor,2,',','.') }}</td>
          <td class="px-6 py-4">{{ $p->created_at->format('d/m/Y') }}</td>
          <td class="px-6 py-4 text-center space-x-2">
            <a href="{{ route('pedidos.edit',$p) }}"
               class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-black rounded-lg shadow-sm hover:shadow transition">
              Editar
            </a>
            <form action="{{ route('pedidos.destroy',$p) }}" method="POST" class="inline">
              @csrf @method('DELETE')
              <button onclick="return confirm('Excluir pedido?')"
                      class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow-md hover:shadow-lg transition font-semibold">
                Excluir
              </button>
            </form>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
@endsection