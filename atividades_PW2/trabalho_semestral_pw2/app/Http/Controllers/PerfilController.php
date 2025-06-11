<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PerfilController extends Controller
{
    // Menu de perfil com opções
    public function index()
    {
        $user = Auth::user();
        return view('perfil.index', compact('user'));
    }

    // Formulário de edição
    public function edit()
    {
        $user = Auth::user();
        return view('perfil.edit', compact('user'));
    }

    // Atualizar dados básicos
    public function update(Request $req)
    {
        $req->validate([
            'name' => 'required|string|max:255',
            'data_nascimento' => 'nullable|date',
        ]);

        $user = Auth::user();
        $user->name = $req->name;
        $user->data_nascimento = $req->data_nascimento;
        $user->save();

        return back()->with('mensagem', 'Perfil atualizado!');
    }


    public function solicitarCriador()
    {
        $user = Auth::user();
        $user->tipo_conta = 'criador';
        $user->save();

        return back()->with('mensagem', 'Você agora é Criador!');
    }

  
    public function solicitarAdmin()
    {
        $user = Auth::user();
        $user->solicitacao_admin = true;
        $user->save();

        return back()->with('mensagem', 'Solicitação de admin enviada!');
    }
}
