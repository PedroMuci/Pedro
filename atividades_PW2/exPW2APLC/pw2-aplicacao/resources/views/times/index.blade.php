@extends('layouts.app')

@section('title', 'Times')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h2 class="text-2xl font-semibold">Times</h2>
  <a href="{{ route('times.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded transition">+ Novo Time</a>
</div>

<form method="GET" action="{{ route('times.index') }}" class="mb-4 flex items-center gap-2">
  <input 
    type="text" 
    name="search" 
    value="{{ request('search') }}" 
    placeholder="Buscar time..." 
    class="input w-full sm:w-64"
  >
  <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded transition">
    🔍
  </button>
</form>

@if(session('success'))
  <div class="mb-4 p-4 bg-green-500 text-white rounded">{{ session('success') }}</div>
@endif

<table class="w-full rounded shadow">
  <thead>
    <tr class="bg-gray-300 dark:bg-gray-700 text-center">
      <th class="px-4 py-2 text-center">Escudo</th>
      <th class="px-4 py-2 text-center">Nome</th>
      <th class="px-4 py-2 text-center">Apelido</th>
      <th class="px-4 py-2 text-center">Fundação</th>
      <th class="px-4 py-2 text-center">Ações</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($times as $time)
    <tr class="border-t dark:border-gray-600 text-center">
      <td class="px-4 py-2">
        <div class="flex justify-center">
          <img src="{{ $time->escudo }}" alt="Escudo" class="icon">
        </div>
      </td>
      <td class="px-4 py-2">
        <div class="flex justify-center">{{ $time->nome_clube }}</div>
      </td>
      <td class="px-4 py-2">
        <div class="flex justify-center">{{ $time->apelido_clube ?? '—' }}</div>
      </td>
      <td class="px-4 py-2">
        <div class="flex justify-center">{{ $time->ano_fundacao }}</div>
      </td>
      <td class="px-4 py-2">
        <div class="flex flex-col items-center gap-1">
          <a href="{{ route('times.edit', $time) }}" class="btn-edit w-24">Editar</a>
          <form action="{{ route('times.destroy', $time) }}" method="POST" onsubmit="return confirm('Deseja excluir este time?')" class="w-24">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete w-full">Excluir</button>
          </form>
        </div>
      </td>
    </tr>
    @empty
    <tr>
      <td colspan="5" class="text-center py-4">Nenhum time registrado.</td>
    </tr>
    @endforelse
  </tbody>
</table>
@endsection
