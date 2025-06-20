@extends('layouts.app')

@section('title', 'Editar Simulação')

@section('content')
<div class="max-w-3xl mx-auto bg-[var(--card-bg)] p-6 rounded shadow-md border border-[var(--border-color)]">
  <h2 class="text-2xl font-semibold mb-6 text-center">Editar Simulação</h2>

  @if(session('error'))
    <div class="mb-4 p-4 bg-red-500 text-white rounded">{{ session('error') }}</div>
  @endif

  <form method="POST" action="{{ route('simulacoes.update', $simulacao) }}" id="simulacao-form" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
      <label class="block mb-1 font-semibold">Competição</label>
      <input type="text" value="{{ $simulacao->nome_competicao }} ({{ ucfirst($simulacao->tipo) }})" class="input w-full bg-gray-200 text-black rounded" readonly>
      <input type="hidden" name="competicao_id" value="{{ $simulacao->competicao_id }}">
    </div>

    {{-- Configurações Liga --}}
    <div id="configuracoes-liga" class="{{ $simulacao->tipo === 'liga' ? '' : 'hidden' }}">
      <label class="block mb-1 font-semibold">Times (liga – número par)</label>
      <div id="times-liga" class="space-y-2"></div>
      <div class="flex gap-2 mt-2">
        <button type="button" id="add-time-liga" class="px-4 py-1 rounded bg-green-600 text-white hover:bg-green-700">+ 2 Times</button>
        <button type="button" id="remove-time-liga" class="px-4 py-1 rounded bg-red-600 text-white hover:bg-red-700">– 2 Times</button>
      </div>
    </div>

    {{-- Configurações Copa --}}
    <div id="configuracoes-copa" class="{{ $simulacao->tipo === 'copa' ? '' : 'hidden' }}">
      <label for="fase" class="block mb-1 font-semibold">Fase</label>
      <select name="fase" id="fase" class="input w-full bg-transparent border border-[var(--border-color)] text-[var(--text-color)] rounded">
        <option value="">Selecione a fase</option>
        @foreach(['final'=>2, 'semi'=>4, 'quartas'=>8, 'oitavas'=>16, '16avos'=>32] as $fase => $num)
          <option value="{{ $fase }}" @if($simulacao->fase === $fase) selected @endif>
            {{ ucfirst($fase) }} ({{ $num }} times)
          </option>
        @endforeach
      </select>
      <div id="times-copa" class="space-y-2 mt-4"></div>
    </div>

    {{-- Botões --}}
    <div class="pt-4 flex justify-center gap-4">
      <button type="submit"
              class="px-6 py-2 bg-blue-600 text-white font-semibold rounded transition"
              onmouseover="this.style.backgroundColor='#1e40af';"
              onmouseout="this.style.backgroundColor='#2563eb';">
        💾 Salvar Alterações
      </button>

      <a href="{{ route('simulacoes.index') }}"
         class="px-6 py-2 bg-red-600 text-white font-semibold rounded transition"
         onmouseover="this.style.backgroundColor='#b91c1c';"
         onmouseout="this.style.backgroundColor='#dc2626';">
        ❌ Cancelar
      </a>
    </div>
  </form>
</div>

<script>
  const allTimes = @json($todosOsTimes->map(fn($t)=>['id'=>$t->id,'nome'=>$t->nome_clube]));
  const timesSelecionados = @json($timesSelecionados);
  const tipo = "{{ $simulacao->tipo }}";

  const ligaDiv     = document.getElementById('configuracoes-liga');
  const copaDiv     = document.getElementById('configuracoes-copa');
  const timesLiga   = document.getElementById('times-liga');
  const timesCopa   = document.getElementById('times-copa');
  const faseSelect  = document.getElementById('fase');

  function createTimeSelect(name, selectedId = null) {
    const select = document.createElement('select');
    select.name = name;
    select.required = true;
    select.className = 'input w-full bg-transparent border border-[var(--border-color)] text-[var(--text-color)] rounded';

    const placeholder = document.createElement('option');
    placeholder.value = '';
    placeholder.innerText = 'Selecione um time';
    select.appendChild(placeholder);

    allTimes.forEach(t => {
      const opt = document.createElement('option');
      opt.value = t.id;
      opt.innerText = t.nome;
      if (t.id === selectedId) opt.selected = true;
      select.appendChild(opt);
    });

    return select;
  }

  if (tipo === 'liga') {
    timesSelecionados.forEach((id, i) => {
      const label = document.createElement('label');
      label.className = 'block mb-1 font-semibold';
      label.innerText = `Time ${i + 1}`;
      timesLiga.appendChild(label);
      timesLiga.appendChild(createTimeSelect(`times[${i}]`, id));
    });
  }

  if (tipo === 'copa') {
    function renderCopaTimes() {
      const map = { final:2, semi:4, quartas:8, oitavas:16, '16avos':32 };
      const qtd = map[faseSelect.value] || 0;
      timesCopa.innerHTML = '';
      for (let i = 0; i < qtd; i++) {
        const label = document.createElement('label');
        label.className = 'block mb-1 font-semibold';
        label.innerText = `Time ${i + 1}`;
        timesCopa.appendChild(label);
        timesCopa.appendChild(createTimeSelect(`times[${i}]`, timesSelecionados[i] ?? null));
      }
    }

    renderCopaTimes();
    faseSelect.addEventListener('change', renderCopaTimes);
  }

  document.getElementById('add-time-liga')?.addEventListener('click', () => {
    const idx = timesLiga.querySelectorAll('select').length;
    for (let i = 0; i < 2; i++) {
      const label = document.createElement('label');
      label.className = 'block mb-1 font-semibold';
      label.innerText = `Time ${idx + i + 1}`;
      timesLiga.appendChild(label);
      timesLiga.appendChild(createTimeSelect(`times[${idx + i}]`));
    }
  });

  document.getElementById('remove-time-liga')?.addEventListener('click', () => {
    for (let i = 0; i < 4; i++) {
      if (timesLiga.lastChild) timesLiga.removeChild(timesLiga.lastChild);
    }
  });
</script>
@endsection
