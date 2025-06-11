<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postagem;

class HistoriaController extends Controller
{
    public function index(Request $req)
    {
        $q = Postagem::where('status','publicado');
        if ($req->filled('busca')) {
            $busca = $req->busca;
            $q->where(function($s)use($busca){
                $s->where('titulo','like',"%$busca%")
                  ->orWhere('palavra_chave1','like',"%$busca%")
                  ->orWhere('palavra_chave2','like',"%$busca%")
                  ->orWhere('palavra_chave3','like',"%$busca%");
            });
        }
        $posts = $q->get();
        return view('historias.index',compact('posts'));
    }

    public function show($id)
    {
        $post = Postagem::findOrFail($id);
        return view('historias.show',compact('post'));
    }
}
