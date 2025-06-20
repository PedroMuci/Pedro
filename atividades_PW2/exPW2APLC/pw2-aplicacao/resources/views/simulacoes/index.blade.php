@extends('layouts.app')

@section('title', 'Simulações')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h2 class="text-2xl font-semibold">Simulações</h2>
  <a href="{{ route('simulacoes.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded transition">+ Nova Simulação</a>
</div>

<form method="GET" action="{{ route('simulacoes.index') }}" class="mb-4 flex items-center gap-2">
  <input 
    type="text" 
    name="search" 
    value="{{ request('search') }}" 
    placeholder="Buscar por competição..." 
    class="px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-black dark:text-white w-full md:w-1/3"
  >
  <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md">
    Buscar
  </button>
</form>

@if(session('success'))
  <div class="mb-4 p-4 bg-green-500 text-white rounded">{{ session('success') }}</div>
@endif

@if(session('error'))
  <div class="mb-4 p-4 bg-red-500 text-white rounded">{{ session('error') }}</div>
@endif

@if ($simulacoes->isEmpty())
  <div class="text-center py-6 text-[var(--text-color)] opacity-80">Nenhuma simulação registrada ainda.</div>
@else
  <table class="w-full rounded shadow">
    <thead>
      <tr class="bg-gray-300 dark:bg-gray-700 text-center">
        <th class="px-4 py-2 text-center">Ícone</th>
        <th class="px-4 py-2 text-center">Competição</th>
        <th class="px-4 py-2 text-center">Formato</th>
        <th class="px-4 py-2 text-center">Times</th>
        <th class="px-4 py-2 text-center">Data</th>
        <th class="px-4 py-2 text-center">Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($simulacoes as $simulacao)
        <tr class="border-t dark:border-gray-600 text-center">
          <td class="px-4 py-2">
            <div class="flex justify-center">
              <img src="{{ $simulacao->icone_competicao }}" alt="ícone competição" class="w-10 h-10 object-contain">
            </div>
          </td>
          <td class="px-4 py-2">
            <div class="flex justify-center">{{ $simulacao->nome_competicao }}</div>
          </td>
          <td class="px-4 py-2 capitalize">
            <div class="flex justify-center">{{ $simulacao->tipo }}</div>
          </td>
          <td class="px-4 py-2">
            <div class="flex justify-center">{{ $simulacao->numero_times }}</div>
          </td>
          <td class="px-4 py-2">
            <div class="flex justify-center">{{ $simulacao->data_simulacao->format('d/m/Y H:i') }}</div>
          </td>
          <td class="px-4 py-2">
            <div class="flex flex-col gap-2 items-center">
              <a href="{{ route('simulacoes.show', $simulacao) }}" class="btn-edit w-24">Ver</a>
              <a href="{{ route('simulacoes.edit', $simulacao) }}" class="btn-edit w-24">Editar</a>
              <form action="{{ route('simulacoes.destroy', $simulacao) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta simulação?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete w-24">Excluir</button>
              </form>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endif
@endsection
