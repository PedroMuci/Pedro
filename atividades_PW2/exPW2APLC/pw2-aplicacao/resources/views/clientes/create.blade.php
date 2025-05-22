@extends('layouts.app')

@section('title','Novo Cliente')

@section('content')
  <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 max-w-2xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100">Cadastrar Cliente</h2>

    <form action="{{ route('clientes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf
      <div>
        <label class="block mb-2 font-medium text-gray-700 dark:text-gray-200">Nome</label>
        <input type="text" name="nome" required
               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none dark:bg-gray-700 dark:text-white">
      </div>
      <div>
        <label class="block mb-2 font-medium text-gray-700 dark:text-gray-200">Email</label>
        <input type="email" name="email" required
               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none dark:bg-gray-700 dark:text-white">
      </div>
      <div>
        <label class="block mb-2 font-medium text-gray-700 dark:text-gray-200">Telefone</label>
        <input type="text" name="telefone"
               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none dark:bg-gray-700 dark:text-white">
      </div>
     
      <div class="flex justify-end space-x-4 pt-4">
        <a href="{{ route('clientes.index') }}"
           class="px-5 py-2 rounded-xl border border-gray-400 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
          Cancelar
        </a>
        <button type="submit"
                class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition">
          Salvar
        </button>
      </div>
    </form>
  </div>
@endsection
