<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function index()
    {
        return Comentario::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'conteudo' => 'required|string',
            'usuario_id' => 'required|exists:usuarios,id',
            'postagem_id' => 'required|exists:postagens,id',
        ]);

        $comentario = Comentario::create($request->all());

        return response()->json($comentario, 201);
    }

    public function show($id)
    {
        $comentario = Comentario::findOrFail($id);
        return response()->json($comentario);
    }

    public function update(Request $request, $id)
    {
        $comentario = Comentario::findOrFail($id);

        $comentario->update($request->only(['conteudo']));

        return response()->json($comentario);
    }

    public function destroy($id)
    {
        $comentario = Comentario::findOrFail($id);
        $comentario->delete();

        return response()->json(['message' => 'Comentário deletado com sucesso.']);
    }
}
