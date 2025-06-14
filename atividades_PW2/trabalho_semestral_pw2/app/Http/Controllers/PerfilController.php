<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\SolicitacaoAdmin;

class PerfilController extends Controller
{
    public function index()
    {
        $user    = Auth::user();
        $pendente = SolicitacaoAdmin::where('user_id', $user->id)
                                    ->where('status', 'pendente')
                                    ->exists();

        return view('perfil.index', compact('user', 'pendente'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('perfil.edit', compact('user'));
    }

    public function update(Request $req)
    {
        $req->validate([
            'name'            => 'required|string|max:255',
            'data_nascimento' => 'nullable|date',
        ]);

        $user = Auth::user();
        $user->update([
            'name'            => $req->name,
            'data_nascimento' => $req->data_nascimento,
        ]);

        return back()->with('mensagem', 'Perfil atualizado!');
    }

    public function solicitarCriador()
    {
        $user = Auth::user();
        $user->update(['tipo_conta'=>'criador']);
        return back()->with('mensagem', 'Você agora é Criador!');
    }

    public function solicitarAdmin()
    {
        $user = Auth::user();

       
        SolicitacaoAdmin::updateOrCreate(
        ['user_id' => $user->id],
        ['status'  => 'pendente']
                                        );


        return back()->with('mensagem', 'Solicitação de admin enviada!');
    }
}
