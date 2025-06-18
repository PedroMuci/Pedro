<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\User;
use App\Models\Postagem;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function index()
    {
        $comentarios = Comentario::with(['user', 'postagem'])->get();
        $usuarios = User::all();
        $postagens = Postagem::all();
        return view('comentarios.index', compact('comentarios', 'usuarios', 'postagens'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'conteudo' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'postagem_id' => 'required|exists:postagens,id',
        ]);

        Comentario::create($dados);

        return redirect()->back()->with('success', 'Comentário criado com sucesso!');
    }

    public function show($id)
    {
        $comentario = Comentario::findOrFail($id);
        return response()->json($comentario);
    }

    public function update(Request $request, $id)
    {
        $comentario = Comentario::findOrFail($id);

        $dados = $request->validate([
            'conteudo' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'postagem_id' => 'required|exists:postagens,id',
        ]);

        $comentario->update($dados);

        return redirect()->route('comentarios.index')->with('success', 'Comentário atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $comentario = Comentario::findOrFail($id);
        $comentario->delete();

        return redirect()->route('comentarios.index')->with('success', 'Comentário deletado com sucesso!');
    }
}
