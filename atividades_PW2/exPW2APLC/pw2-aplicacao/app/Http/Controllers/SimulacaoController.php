<?php

namespace App\Http\Controllers;

use App\Models\Competicao;
use App\Models\Simulacao;
use App\Models\SimulacaoJogo;
use App\Models\SimulacaoTime;
use App\Models\SimulacaoLigaTime;
use App\Models\Time;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SimulacaoController extends Controller
{
    public function index()
    {
        $simulacoes = Simulacao::latest()->get();
        return view('simulacoes.index', compact('simulacoes'));
    }

    public function create()
    {
        $competicoes  = Competicao::all();
        $todosOsTimes = Time::all();

        return view('simulacoes.create', compact('competicoes', 'todosOsTimes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'competicao_id' => 'required|exists:competicoes,id',
            'fase'          => 'nullable|string',
            'times'         => 'required|array|min:2',
            'times.*'       => 'exists:times,id',
        ]);

        $competicao = Competicao::findOrFail($data['competicao_id']);
        $countTimes = count($data['times']);

        if ($competicao->tipo === 'liga' && $countTimes % 2 !== 0) {
            return back()
                ->with('error', 'Para liga, é necessário número par de times.')
                ->withInput();
        }

        if ($competicao->tipo === 'copa'
            && ! in_array($countTimes, [2,4,8,16,32])
        ) {
            return back()
                ->with('error', 'Número de times inválido para copa.')
                ->withInput();
        }

 
        $simulacao = Simulacao::create([
            'competicao_id'    => $competicao->id,
            'nome_competicao'  => $competicao->nome,
            'icone_competicao' => $competicao->icone,
            'tipo'             => $competicao->tipo,
            'fase'             => $data['fase'] ?? null,
            'numero_times'     => $countTimes,
            'data_simulacao'   => Carbon::now(),
        ]);

      
        foreach ($data['times'] as $timeId) {
            $time = Time::findOrFail($timeId);

            SimulacaoTime::create([
                'simulacao_id' => $simulacao->id,
                'time_id'      => $time->id,
                'nome_time'    => $time->nome_clube,
                'escudo_time'  => $time->escudo,
            ]);

        
            if ($competicao->tipo === 'liga') {
                SimulacaoLigaTime::create([
                    'simulacao_id'  => $simulacao->id,
                    'time_id'       => $time->id,
                    'pontos'        => 0,
                    'gols_marcados' => 0,
                    'gols_sofridos' => 0,
                ]);
            }
        }

        return redirect()
            ->route('simulacoes.index')
            ->with('success', 'Simulação criada com sucesso.');
    }

public function show(Simulacao $simulacao)
{
  
    $simulacao->load([
        'simulacaoTimes',     
        'simulacaoLigaTimes', 
        'jogos.timeA',        
        'jogos.timeB',        
    ]);

    return view('simulacoes.show', compact('simulacao'));
}


    public function edit(Simulacao $simulacao)
    {
        $competicoes      = Competicao::all();
        $todosOsTimes     = Time::all();
        $timesSelecionados = $simulacao
            ->simulacaoTimes
            ->pluck('time_id');

        return view('simulacoes.edit', compact(
            'simulacao',
            'competicoes',
            'todosOsTimes',
            'timesSelecionados'
        ));
    }

    public function update(Request $request, Simulacao $simulacao)
    {
        $data = $request->validate([
            'competicao_id' => 'required|exists:competicoes,id',
            'fase'          => 'nullable|string',
            'times'         => 'required|array|min:2',
            'times.*'       => 'exists:times,id',
        ]);

        $competicao = Competicao::findOrFail($data['competicao_id']);
        $countTimes = count($data['times']);

        if ($competicao->tipo === 'liga' && $countTimes % 2 !== 0) {
            return back()
                ->with('error', 'Para liga, é necessário número par de times.')
                ->withInput();
        }

        if ($competicao->tipo === 'copa'
            && ! in_array($countTimes, [2,4,8,16,32])
        ) {
            return back()
                ->with('error', 'Número de times inválido para copa.')
                ->withInput();
        }

        // Atualiza dados principais
        $simulacao->update([
            'competicao_id'    => $competicao->id,
            'nome_competicao'  => $competicao->nome,
            'icone_competicao' => $competicao->icone,
            'tipo'             => $competicao->tipo,
            'fase'             => $data['fase'] ?? null,
            'numero_times'     => $countTimes,
            'data_simulacao'   => Carbon::now(),
        ]);

        // Limpa registros antigos
        $simulacao->jogos()->delete();
        SimulacaoTime::where('simulacao_id', $simulacao->id)->delete();
        SimulacaoLigaTime::where('simulacao_id', $simulacao->id)->delete();

        // Reinsere
        foreach ($data['times'] as $timeId) {
            $time = Time::findOrFail($timeId);

            SimulacaoTime::create([
                'simulacao_id' => $simulacao->id,
                'time_id'      => $time->id,
                'nome_time'    => $time->nome_clube,
                'escudo_time'  => $time->escudo,
            ]);

            if ($competicao->tipo === 'liga') {
                SimulacaoLigaTime::create([
                    'simulacao_id'  => $simulacao->id,
                    'time_id'       => $time->id,
                    'pontos'        => 0,
                    'gols_marcados' => 0,
                    'gols_sofridos' => 0,
                ]);
            }
        }

        return redirect()
            ->route('simulacoes.index')
            ->with('success', 'Simulação atualizada com sucesso.');
    }

    public function destroy(Simulacao $simulacao)
    {
        $simulacao->delete();
        return redirect()
            ->route('simulacoes.index')
            ->with('success', 'Simulação excluída com sucesso.');
    }
}
