@extends('layouts.app')

@section('title','Clientes')

@section('content')
  <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8">
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
      <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
        Clientes
      </h2>
      <a href="{{ route('clientes.create') }}"
         class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl shadow-md hover:shadow-lg transition font-semibold">
        + Novo Cliente
      </a>
    </div>

    <form method="GET" action="{{ route('clientes.index') }}" class="mb-6">
     <input type="text" name="busca" value="{{ request('busca') }}"
       placeholder="Buscar por nome"
       class="w-full md:w-1/3 px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 dark:text-gray-900"
>
    </form>

    <div class="overflow-x-auto">
      <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-700">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-bold uppercase">Nome</th>
          <th class="px-6 py-3 text-left text-xs font-bold uppercase">Email</th>
          <th class="px-6 py-3 text-left text-xs font-bold uppercase">Telefone</th>
          <th class="px-6 py-3 text-center text-xs font-bold uppercase">Ações</th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
        @foreach($clientes as $c)
          <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">

            <td class="px-6 py-4">{{ $c->nome }}</td>
            <td class="px-6 py-4">{{ $c->email }}</td>
            <td class="px-6 py-4">{{ $c->telefone }}</td>
            <td class="px-6 py-4 text-center space-x-2">
              <a href="{{ route('clientes.edit',$c) }}"
                 class="px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-black rounded-xl shadow-md hover:shadow-lg transition font-semibold">
                Editar
              </a>
              <form action="{{ route('clientes.destroy',$c) }}" method="POST" class="inline">
                @csrf @method('DELETE')
                <button onclick="return confirm('Excluir cliente?')"
                        class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow-md hover:shadow-lg transition font-semibold">
                  Excluir
                </button>
              </form>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>

    <div class="mt-6">
      {{ $clientes->links() }}
    </div>
  </div>
@endsection
