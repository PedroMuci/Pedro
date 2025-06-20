@extends('layouts.app')

@section('title', 'Nova Simulação')

@section('content')
  <div class="max-w-3xl mx-auto bg-[var(--card-bg)] p-6 rounded shadow-md border border-[var(--border-color)]">
    <h2 class="text-2xl font-semibold mb-6 text-center">Criar Nova Simulação</h2>

    @if(session('error'))
      <div class="mb-4 p-4 bg-red-500 text-white rounded">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('simulacoes.store') }}" id="simulacao-form" class="space-y-4">
      @csrf

      <div>
        <label for="competicao_id" class="block mb-1 font-semibold">Competição</label>
        <select name="competicao_id" id="competicao_id" class="input w-full bg-transparent border border-[var(--border-color)] text-[var(--text-color)] rounded" required>
          <option value="">Selecione a competição</option>
          @foreach($competicoes as $competicao)
            <option value="{{ $competicao->id }}" data-tipo="{{ $competicao->tipo }}">
              {{ $competicao->nome }} ({{ ucfirst($competicao->tipo) }})
            </option>
          @endforeach
        </select>
      </div>

      <div id="configuracoes-liga" class="hidden">
        <label class="block mb-1 font-semibold">Times (liga – sempre número par)</label>
        <div id="times-liga" class="space-y-2"></div>
        <div class="flex gap-2 mt-2">
          <button type="button" id="add-time-liga" class="px-4 py-1 rounded bg-green-600 text-white hover:bg-green-700">+ 2 Times</button>
          <button type="button" id="remove-time-liga" class="px-4 py-1 rounded bg-red-600 text-white hover:bg-red-700">– 2 Times</button>
        </div>
      </div>

      <div id="configuracoes-copa" class="hidden">
        <label for="fase" class="block mb-1 font-semibold">Fase (copa)</label>
        <select name="fase" id="fase" class="input w-full bg-transparent border border-[var(--border-color)] text-[var(--text-color)] rounded">
          <option value="">Selecione a fase</option>
          <option value="final">Final (2 times)</option>
          <option value="semi">Semifinal (4 times)</option>
          <option value="quartas">Quartas (8 times)</option>
          <option value="oitavas">Oitavas (16 times)</option>
          <option value="16avos">16avos (32 times)</option>
        </select>
        <div id="times-copa" class="space-y-2 mt-4"></div>
      </div>

      <div class="pt-4 flex justify-center gap-4">
        <button type="submit"
                class="px-6 py-2 bg-green-600 text-white font-semibold rounded transition"
                onmouseover="this.style.backgroundColor='#15803d';"
                onmouseout="this.style.backgroundColor='#16a34a';">
          ⚔️ Criar Duelo
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
    const competicaoSelect = document.getElementById('competicao_id');
    const ligaDiv  = document.getElementById('configuracoes-liga');
    const copaDiv  = document.getElementById('configuracoes-copa');
    const timesLiga = document.getElementById('times-liga');
    const timesCopa = document.getElementById('times-copa');
    const fase      = document.getElementById('fase');
    let timesDisponiveis = [];

    function createTimeSelect(name) {
      const select = document.createElement('select');
      select.name = name;
      select.required = true;
      select.className = 'input w-full bg-transparent border border-[var(--border-color)] text-[var(--text-color)] rounded';
      const placeholder = document.createElement('option');
      placeholder.value = '';
      placeholder.innerText = 'Selecione um time';
      select.appendChild(placeholder);
      timesDisponiveis.forEach(t => {
        const opt = document.createElement('option');
        opt.value = t.id;
        opt.innerText = t.nome;
        select.appendChild(opt);
      });
      return select;
    }

    competicaoSelect.addEventListener('change', e => {
      const tipo = e.target.selectedOptions[0]?.dataset.tipo;
      const id   = +e.target.value;

      timesDisponiveis = allTimes;

      ligaDiv.classList.add('hidden');
      copaDiv.classList.add('hidden');
      timesLiga.innerHTML = '';
      timesCopa.innerHTML = '';
      fase.value = '';

      if (!id) return;

      if (tipo === 'liga') {
        ligaDiv.classList.remove('hidden');
        for (let i = 0; i < 2; i++) {
          const label = document.createElement('label');
          label.className = 'block mb-1 font-semibold';
          label.innerText = `Time ${i + 1}`;
          timesLiga.appendChild(label);
          timesLiga.appendChild(createTimeSelect(`times[${i}]`));
        }
      }

      if (tipo === 'copa') {
        copaDiv.classList.remove('hidden');
      }
    });

    document.getElementById('add-time-liga').onclick = () => {
      const idx = timesLiga.querySelectorAll('select').length;
      for (let i = 0; i < 2; i++) {
        const label = document.createElement('label');
        label.className = 'block mb-1 font-semibold';
        label.innerText = `Time ${idx + i + 1}`;
        timesLiga.appendChild(label);
        timesLiga.appendChild(createTimeSelect(`times[${idx + i}]`));
      }
    };

    document.getElementById('remove-time-liga').onclick = () => {
      for (let i = 0; i < 4; i++) {
        if (timesLiga.lastChild) timesLiga.removeChild(timesLiga.lastChild);
      }
    };

    fase.onchange = () => {
      const map = { final:2, semi:4, quartas:8, oitavas:16, '16avos':32 };
      const qtd = map[fase.value] || 0;
      timesCopa.innerHTML = '';
      for (let i = 0; i < qtd; i++) {
        const label = document.createElement('label');
        label.className = 'block mb-1 font-semibold';
        label.innerText = `Time ${i + 1}`;
        timesCopa.appendChild(label);
        timesCopa.appendChild(createTimeSelect(`times[${i}]`));
      }
    };
  </script>
@endsection
