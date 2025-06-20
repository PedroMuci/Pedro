<?php

namespace App\Http\Controllers;

use App\Models\Competicao;
use App\Models\Time;
use Illuminate\Http\Request;

class CompeticaoController extends Controller
{
    public function index()
    {
        $competicoes = Competicao::with('times')->get();
        return view('competicoes.index', compact('competicoes'));
    }

    public function create()
    {
        $times = Time::all();
        return view('competicoes.create', compact('times'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'icone' => 'required|url',
            'tipo' => 'required|in:liga,copa',
            'data_criacao' => 'required|date',
            'edicao' => 'required|integer',
            'times' => 'nullable|array',
            'times.*' => 'exists:times,id',
        ]);

        $competicao = Competicao::create($data);
        if (!empty($data['times'])) {
            $competicao->times()->sync($data['times']);
        }

        return redirect()->route('competicoes.index')->with('success', 'Competição criada com sucesso.');
    }

    public function edit(Competicao $competicao)
    {
        $times = Time::all();
        $selectedTimes = $competicao->times()->pluck('id')->toArray();
        return view('competicoes.edit', compact('competicao', 'times', 'selectedTimes'));
    }

    public function update(Request $request, Competicao $competicao)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'icone' => 'required|url',
            'tipo' => 'required|in:liga,copa',
            'data_criacao' => 'required|date',
            'edicao' => 'required|integer',
            'times' => 'nullable|array',
            'times.*' => 'exists:times,id',
        ]);

        $competicao->update($data);
        $competicao->times()->sync($data['times'] ?? []);

        return redirect()->route('competicoes.index')->with('success', 'Competição atualizada com sucesso.');
    }

    public function destroy(Competicao $competicao)
    {
        $competicao->times()->detach();
        $competicao->delete();
        return redirect()->route('competicoes.index')->with('success', 'Competição removida com sucesso.');
    }
}
