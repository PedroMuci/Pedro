@extends('layouts.app')

@section('title', 'Editar Time')

@section('content')
<div class="max-w-2xl mx-auto bg-[var(--card-bg)] p-6 rounded shadow-md border border-[var(--border-color)]">
  <h2 class="text-2xl font-semibold mb-6 text-center">Editar Time</h2>

  <form method="POST" action="{{ route('times.update', $time) }}" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
      <label for="nome_clube" class="block mb-1 font-semibold">Nome do Clube</label>
      <input type="text" name="nome_clube" id="nome_clube" value="{{ old('nome_clube', $time->nome_clube) }}"
             class="input w-full p-2 border rounded bg-transparent text-[var(--text-color)] border-[var(--border-color)]" required>
    </div>

    <div>
      <label for="apelido_clube" class="block mb-1 font-semibold">Apelido</label>
      <input type="text" name="apelido_clube" id="apelido_clube" value="{{ old('apelido_clube', $time->apelido_clube) }}"
             class="input w-full p-2 border rounded bg-transparent text-[var(--text-color)] border-[var(--border-color)]">
    </div>

    <div>
      <label for="escudo" class="block mb-1 font-semibold">URL do Escudo</label>
      <input type="url" name="escudo" id="escudo" value="{{ old('escudo', $time->escudo) }}"
             class="input w-full p-2 border rounded bg-transparent text-[var(--text-color)] border-[var(--border-color)]" required>
    </div>

    <div>
      <label for="ano_fundacao" class="block mb-1 font-semibold">Ano de Fundação</label>
      <input type="number" name="ano_fundacao" id="ano_fundacao" value="{{ old('ano_fundacao', $time->ano_fundacao) }}"
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

      <a href="{{ route('times.index') }}"
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
