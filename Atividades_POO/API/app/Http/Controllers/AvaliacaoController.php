<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\User;
use App\Models\Postagem;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    public function index()
    {
        $avaliacoes = Avaliacao::with(['user', 'postagem'])->get();
        $usuarios = User::all();
        $postagens = Postagem::all();
        return view('avaliacoes.index', compact('avaliacoes', 'usuarios', 'postagens'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nota' => 'required|integer|min:0|max:10',
            'comentario' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'postagem_id' => 'required|exists:postagens,id',
        ]);

        Avaliacao::create($dados);

        return redirect()->back()->with('success', 'Avaliação criada com sucesso!');
    }

    public function show($id)
    {
        $avaliacao = Avaliacao::findOrFail($id);
        return response()->json($avaliacao);
    }

    public function update(Request $request, $id)
    {
        $avaliacao = Avaliacao::findOrFail($id);

        $dados = $request->validate([
            'nota' => 'required|integer|min:0|max:10',
            'comentario' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'postagem_id' => 'required|exists:postagens,id',
        ]);

        $avaliacao->update($dados);

        return redirect()->route('avaliacoes.index')->with('success', 'Avaliação atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $avaliacao = Avaliacao::findOrFail($id);
        $avaliacao->delete();

        return redirect()->route('avaliacoes.index')->with('success', 'Avaliação deletada com sucesso!');
    }
}
