<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avaliacao;
use App\Models\Postagem;
use Illuminate\Support\Facades\Auth;

class AvaliacaoController extends Controller
{
    public function store(Request $req,$id)
    {
        $req->validate(['nota'=>'required|integer|min:0|max:10']);
        Avaliacao::updateOrCreate(
            ['user_id'=>Auth::id(),'postagem_id'=>$id],
            ['nota'=>$req->nota]
        );

        $post = Postagem::find($id);
        $media = $post->avaliacoes()->avg('nota');
        $post->update(['nota_media'=>$media]);
        return back()->with('mensagem','Avaliação salva.');
    }
}
