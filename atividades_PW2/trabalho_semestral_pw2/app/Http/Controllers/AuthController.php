<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $req)
    {
        $cred = $req->only('email','password');

        if (Auth::attempt($cred)) {
            return redirect()->route('menu');
        }

        return back()->with('erro_login', 'Usuário não encontrado ou senha incorreta.');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $req)
    {
        $req->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed|min:6',
            'data_nascimento'=>'nullable|date'
        ]);

        User::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'password'=>Hash::make($req->password),
            'data_nascimento'=>$req->data_nascimento
        ]);

        return redirect()->route('login.show')->with('mensagem','Cadastro realizado.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.show');
    }

    public function perfil()
    {
        return view('auth.perfil', ['user' => Auth::user()]);
    }

    public function atualizarPerfil(Request $req)
    {
        $user = Auth::user();
        $req->validate([
            'name'=>'required|string',
            'data_nascimento'=>'nullable|date',
            'tipo'=>'required|in:leitor,autor,admin'
        ]);

        $user->update([
            'name'=>$req->name,
            'data_nascimento'=>$req->data_nascimento,
            'tipo'=>$req->tipo
        ]);

        return back()->with('mensagem', 'Perfil atualizado com sucesso.');
    }
}
