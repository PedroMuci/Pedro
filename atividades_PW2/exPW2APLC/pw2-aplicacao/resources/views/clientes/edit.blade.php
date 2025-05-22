@extends('layouts.app')

@section('title','Editar Cliente')

@section('content')
  <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 max-w-lg mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100">
      Editar Cliente
    </h2>

    <form action="{{ route('clientes.update', $cliente) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
      @csrf
      @method('PUT')

      <div>
        <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Nome</label>
        <input type="text" name="nome" value="{{ $cliente->nome }}" required
               class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700">
      </div>

      <div>
        <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Email</label>
        <input type="email" name="email" value="{{ $cliente->email }}" required
               class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700">
      </div>

      <div>
        <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Telefone</label>
        <input type="text" name="telefone" value="{{ $cliente->telefone }}"
               class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700">
      </div>

      <div class="flex justify-between">
        <a href="{{ route('clientes.index') }}"
           class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-xl shadow-md hover:shadow-lg transition font-semibold">
          Cancelar
        </a>
        <button type="submit"
                class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl shadow-md hover:shadow-lg transition font-semibold">
          Atualizar
        </button>
      </div>
    </form>
  </div>
@endsection