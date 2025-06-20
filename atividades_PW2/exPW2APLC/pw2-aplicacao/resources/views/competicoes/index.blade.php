@extends('layouts.app')

@section('title', 'Competições')

@section('content')
<div class="flex justify-between items-center mb-6">
  <h2 class="text-2xl font-semibold">Competições</h2>
  <a href="{{ route('competicoes.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded transition">+ Nova Competição</a>
</div>

@if(session('success'))
  <div class="mb-4 p-4 bg-green-500 text-white rounded">{{ session('success') }}</div>
@endif

<table class="w-full rounded shadow">
  <thead>
    <tr class="bg-gray-300 dark:bg-gray-700 text-center">
      <th class="px-4 py-2 text-center">Ícone</th>
      <th class="px-4 py-2 text-center">Nome</th>
      <th class="px-4 py-2 text-center">Tipo</th>
      <th class="px-4 py-2 text-center">Edição</th>
      <th class="px-4 py-2 text-center">Criada em</th>
      <th class="px-4 py-2 text-center">Ações</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($competicoes as $competicao)
    <tr class="border-t dark:border-gray-600 text-center align-middle">
      <td class="px-4 py-2">
        <div class="flex justify-center">
          <img src="{{ $competicao->icone }}" alt="Ícone" class="h-12 w-12">
        </div>
      </td>
      <td class="px-4 py-2">
        <div class="flex justify-center">{{ $competicao->nome }}</div>
      </td>
      <td class="px-4 py-2">
        <div class="flex justify-center capitalize">{{ $competicao->tipo }}</div>
      </td>
      <td class="px-4 py-2">
        <div class="flex justify-center">{{ $competicao->edicao }}</div>
      </td>
      <td class="px-4 py-2">
        <div class="flex justify-center">{{ \Carbon\Carbon::parse($competicao->data_criacao)->format('d/m/Y') }}</div>
      </td>
      <td class="px-4 py-2">
        <div class="flex flex-col items-center gap-1">
          <a href="{{ route('competicoes.edit', $competicao) }}" class="btn-edit w-24">Editar</a>
          <form action="{{ route('competicoes.destroy', $competicao) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?')" class="w-24">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete w-full">Excluir</button>
          </form>
        </div>
      </td>
    </tr>
    @empty
    <tr>
      <td colspan="6" class="text-center py-4">Nenhuma competição cadastrada.</td>
    </tr>
    @endforelse
  </tbody>
</table>
@endsection
