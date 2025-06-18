<?php

namespace App\Http\Controllers;

use App\Models\Postagem;
use Illuminate\Http\Request;

class PostagemController extends Controller
{
    public function index()
    {
        $postagens = Postagem::all();
        return view('postagens.index', compact('postagens'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'titulo' => 'required|string',
            'texto' => 'required|string',
            'imagem1' => 'nullable|string',
            'imagem2' => 'nullable|string',
            'imagem3' => 'nullable|string',
            'video' => 'nullable|string',
            'musica' => 'nullable|string',
            'fonte' => 'nullable|string',
            'palavra_chave1' => 'nullable|string',
            'palavra_chave2' => 'nullable|string',
            'palavra_chave3' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        Postagem::create($dados);

        return redirect()->route('postagens.index')->with('success', 'Postagem criada com sucesso!');
    }

    public function show($id)
    {
        $postagem = Postagem::findOrFail($id);
        return response()->json($postagem);
    }

    public function update(Request $request, $id)
    {
        $postagem = Postagem::findOrFail($id);

        $dados = $request->validate([
            'titulo' => 'required|string',
            'texto' => 'required|string',
            'imagem1' => 'nullable|string',
            'imagem2' => 'nullable|string',
            'imagem3' => 'nullable|string',
            'video' => 'nullable|string',
            'musica' => 'nullable|string',
            'fonte' => 'nullable|string',
            'palavra_chave1' => 'nullable|string',
            'palavra_chave2' => 'nullable|string',
            'palavra_chave3' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $postagem->update($dados);

        return redirect()->route('postagens.index')->with('success', 'Postagem atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $postagem = Postagem::findOrFail($id);
        $postagem->delete();

        return redirect()->route('postagens.index')->with('success', 'Postagem deletada com sucesso!');
    }
}
