@extends('layouts.app')

@section('title', 'Editar Competição')

@section('content')
<div class="max-w-2xl mx-auto bg-[var(--card-bg)] p-6 rounded shadow-md border border-[var(--border-color)]">
  <h2 class="text-2xl font-semibold mb-6 text-center">Editar Competição</h2>

  <form method="POST" action="{{ route('competicoes.update', $competicao) }}" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
      <label for="nome" class="block mb-1 font-semibold">Nome</label>
      <input type="text" name="nome" id="nome" value="{{ old('nome', $competicao->nome) }}"
             class="input w-full p-2 border rounded bg-transparent text-[var(--text-color)] border-[var(--border-color)]" required>
    </div>

    <div>
      <label for="icone" class="block mb-1 font-semibold">URL do Ícone</label>
      <input type="url" name="icone" id="icone" value="{{ old('icone', $competicao->icone) }}"
             class="input w-full p-2 border rounded bg-transparent text-[var(--text-color)] border-[var(--border-color)]" required>
    </div>

    <div>
      <label for="tipo" class="block mb-1 font-semibold">Tipo</label>
      <select name="tipo" id="tipo"
              class="input w-full p-2 border rounded bg-transparent text-[var(--text-color)] border-[var(--border-color)]" required>
        <option value="">Selecione</option>
        <option value="liga" @selected(old('tipo', $competicao->tipo) === 'liga')>Liga</option>
        <option value="copa" @selected(old('tipo', $competicao->tipo) === 'copa')>Copa</option>
      </select>
    </div>

    <div>
      <label for="data_criacao" class="block mb-1 font-semibold">Data de Criação</label>
      <input type="date" name="data_criacao" id="data_criacao"
             value="{{ old('data_criacao', \Carbon\Carbon::parse($competicao->data_criacao)->format('Y-m-d')) }}"
             class="input w-full p-2 border rounded bg-transparent text-[var(--text-color)] border-[var(--border-color)]" required>
    </div>

    <div>
      <label for="edicao" class="block mb-1 font-semibold">Número da Edição</label>
      <input type="number" name="edicao" id="edicao" value="{{ old('edicao', $competicao->edicao) }}"
             class="input w-full p-2 border rounded bg-transparent text-[var(--text-color)] border-[var(--border-color)]" required>
    </div>

    <div class="pt-4 flex justify-center gap-4">
      <button type="submit"
              class="px-6 py-2 rounded font-semibold transition"
              style="background-color: #16a34a; color: white;"
              onmouseover="this.style.backgroundColor='#15803d';"
              onmouseout="this.style.backgroundColor='#16a34a';">
        💾 Salvar Alterações
      </button>

      <a href="{{ route('competicoes.index') }}"
         class="px-6 py-2 rounded font-semibold transition text-white"
         style="background-color: #dc2626;"
         onmouseover="this.style.backgroundColor='#b91c1c';"
         onmouseout="this.style.backgroundColor='#dc2626';">
        ❌ Cancelar
      </a>
    </div>
  </form>
</div>
@endsection
