<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postagem;
use App\Models\SolicitacaoAdmin;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $posts = Postagem::where('status','pendente')->get();
        $solicitacoes = SolicitacaoAdmin::where('status','pendente')->get();
        return view('admin.index',compact('posts','solicitacoes'));
    }

    public function aprovarPostagem($id)
    {
        Postagem::find($id)->update(['status'=>'publicado']);
        return back()->with('mensagem','Post aprovado.');
    }

    public function devolverPostagem(Request $req,$id)
    {
        $req->validate(['mensagem_devolucao'=>'required']);
        Postagem::find($id)->update([
            'status'=>'devolvido',
            'mensagem_devolucao'=>$req->mensagem_devolucao
        ]);
        return back()->with('mensagem','Post devolvido.');
    }

    public function excluirPostagem($id)
    {
        Postagem::destroy($id);
        return back()->with('mensagem','Post excluído.');
    }

    public function aprovarSolicitacao($id)
    {
        $s = SolicitacaoAdmin::find($id);
        $user = $s->user;
        $user->update(['tipo_conta'=>'admin']);
        $s->update(['status'=>'aprovado']);
        return back()->with('mensagem','Usuário é agora admin.');
    }

    public function negarSolicitacao($id)
    {
        SolicitacaoAdmin::find($id)->update(['status'=>'negado']);
        return back()->with('mensagem','Solicitação negada.');
    }
}
