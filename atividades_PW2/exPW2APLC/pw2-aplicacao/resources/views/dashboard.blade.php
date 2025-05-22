@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
  <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 max-w-2xl mx-auto mt-10">

    <h2 class="text-xl font-semibold mb-10 text-gray-800 dark:text-gray-100 text-center">
      Você está logado!
    </h2>


    <div class="flex flex-col sm:flex-row justify-center items-center gap-6">
 
      <a href="{{ route('clientes.index') }}"
         class="px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white text-lg text-center rounded-xl border-2 border-indigo-800 shadow-lg hover:shadow-xl transition-all font-bold">
        Ir para Clientes
      </a>

  
      <a href="{{ route('pedidos.index') }}"
         class="px-8 py-4 bg-green-600 hover:bg-green-700 text-white text-lg text-center rounded-xl border-2 border-green-800 shadow-lg hover:shadow-xl transition-all font-bold">
        Ir para Pedidos
      </a>
    </div>
  </div>
@endsection