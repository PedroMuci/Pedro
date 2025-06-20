@extends('layouts.app')

@section('title', 'Simulação: ' . $simulacao->nome_competicao)

@section('content')
  {{-- Cabeçalho --}}
  <div class="max-w-3xl mx-auto mb-6 flex items-center gap-4 bg-[var(--card-bg)] p-4 rounded shadow-md border border-[var(--border-color)]">
    <div class="h-10 w-10 flex-shrink-0 flex justify-center items-center">
      <img src="{{ $simulacao->icone_competicao }}"
           alt="Ícone {{ $simulacao->nome_competicao }}"
           class="h-6 w-6 object-contain rounded">
    </div>
    <div>
      <h2 class="text-2xl font-semibold">{{ $simulacao->nome_competicao }}</h2>
      <p class="text-sm text-[var(--text-color)] opacity-80">
        Formato: <span class="capitalize">{{ $simulacao->tipo }}</span>
        @if($simulacao->tipo === 'copa' && $simulacao->fase)
          — Fase: <strong>{{ ucfirst($simulacao->fase) }}</strong>
        @endif
      </p>
    </div>
  </div>

  @if($simulacao->tipo === 'liga')
    {{-- Liga --}}
    <div class="max-w-3xl mx-auto mb-6">
      <table class="w-full rounded shadow">
        <thead>
          <tr class="bg-gray-300 dark:bg-gray-700 text-center">
            <th class="px-4 py-2">Posição</th>
            <th class="px-4 py-2">Escudo</th>
            <th class="px-4 py-2">Time</th>
            <th class="px-4 py-2">Pontos</th>
            <th class="px-4 py-2">GM</th>
            <th class="px-4 py-2">GS</th>
            <th class="px-4 py-2">SG</th>
          </tr>
        </thead>
        <tbody>
          @foreach($simulacao->simulacaoTimes as $idx => $st)
            <tr class="border-t dark:border-gray-600">
              <td class="px-4 py-2"><div class="flex justify-center">{{ $idx + 1 }}</div></td>
              <td class="px-4 py-2"><div class="flex justify-center"><img src="{{ $st->escudo_time }}" class="h-6 w-6" alt="{{ $st->nome_time }}"></div></td>
              <td class="px-4 py-2"><div class="flex justify-center">{{ $st->nome_time }}</div></td>
              <td class="px-4 py-2"><div class="flex justify-center">{{ $st->pontos ?? 0 }}</div></td>
              <td class="px-4 py-2"><div class="flex justify-center">{{ $st->gols_marcados ?? 0 }}</div></td>
              <td class="px-4 py-2"><div class="flex justify-center">{{ $st->gols_sofridos ?? 0 }}</div></td>
              <td class="px-4 py-2"><div class="flex justify-center">{{ ($st->gols_marcados ?? 0) - ($st->gols_sofridos ?? 0) }}</div></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @else
    {{-- Copa --}}
    <div class="max-w-3xl mx-auto mb-6">
      <div class="space-y-6">
        @php $times = $simulacao->simulacaoTimes; @endphp
        @for($i = 0; $i < $times->count(); $i += 2)
          @php
            $a = $times[$i];
            $b = $times->get($i+1);
          @endphp
          <div class="flex justify-center items-center gap-4 p-2 border rounded bg-[var(--card-bg)]">
            <div class="flex items-center gap-2">
              <img src="{{ $a->escudo_time }}" class="h-6 w-6" alt="{{ $a->nome_time }}">
              <span>{{ $a->nome_time }}</span>
            </div>
            <span class="font-bold">×</span>
            <div class="flex items-center gap-2">
              <img src="{{ $b->escudo_time }}" class="h-6 w-6" alt="{{ $b->nome_time }}">
              <span>{{ $b->nome_time }}</span>
            </div>
          </div>
        @endfor
      </div>
    </div>
  @endif

    {{-- Voltar --}}
    <div class="max-w-3xl mx-auto text-center">
    <a href="{{ route('simulacoes.index') }}"
        class="px-4 py-2 bg-[var(--card-bg)] hover:bg-[var(--primary-color)] text-[var(--text-color)] hover:text-white rounded transition border border-[var(--border-color)] hover:border-[var(--primary-color)]">
        ← Voltar
    </a>
    </div>
@endsection