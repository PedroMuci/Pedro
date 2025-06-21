<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postagem;
use Illuminate\Support\Facades\Auth;

class PostagemController extends Controller
{
    public function index()
    {
        $posts = Auth::user()->postagens;
        return view('gerenciar.index', compact('posts'));
    }

    public function create()
    {
        return view('gerenciar.create');
    }

    public function store(Request $req)
    {
        $req->validate([
            'titulo' => 'required',
            'texto' => 'required',
            'imagem1' => 'required|url',
            'fonte' => 'required'
        ]);

        Postagem::create(array_merge(
            $req->only([
                'titulo','texto','imagem1','imagem2','imagem3',
                'video','musica','fonte',
                'palavra_chave1','palavra_chave2','palavra_chave3'
            ]),
            ['user_id' => Auth::id()]
        ));

        return redirect()->route('gerenciar.index')->with('mensagem', 'Post criado.');
    }

    public function edit($id)
    {
        $user = Auth::user();

        if ($user->tipo_conta === 'admin') {
            $post = Postagem::findOrFail($id);
        } else {
            $post = $user->postagens()->findOrFail($id);
        }

        return view('gerenciar.edit', compact('post'));
    }

    public function update(Request $req, $id)
    {
        $req->validate([
            'titulo' => 'required',
            'texto' => 'required',
            'imagem1' => 'required|url',
            'fonte' => 'required'
        ]);

        $user = Auth::user();

        if ($user->tipo_conta === 'admin') {
            $post = Postagem::findOrFail($id);
        } else {
            $post = $user->postagens()->findOrFail($id);
        }

        $post->update($req->only([
            'titulo','texto','imagem1','imagem2','imagem3',
            'video','musica','fonte',
            'palavra_chave1','palavra_chave2','palavra_chave3'
        ]));

        return back()->with('mensagem', 'Post atualizado.');
    }

    public function destroy($id)
    {
        $user = Auth::user();

        if ($user->tipo_conta === 'admin') {
            $post = Postagem::findOrFail($id);
        } else {
            $post = $user->postagens()->findOrFail($id);
        }

        $post->delete();

        return back()->with('mensagem', 'Post excluído.');
    }
}
