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
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email',
            'password'         => 'required|confirmed|min:6',
            'data_nascimento'  => 'nullable|date',
        ], [
            'name.required'             => 'O campo nome é obrigatório.',
            'email.required'            => 'O campo email é obrigatório.',
            'email.email'               => 'Informe um email válido.',
            'email.unique'              => 'Este email já está em uso.',
            'password.required'         => 'O campo senha é obrigatório.',
            'password.min'              => 'A senha deve conter no mínimo 6 caracteres.',
            'password.confirmed'        => 'A senha e a confirmação não coincidem.',
            'data_nascimento.date'      => 'Informe uma data de nascimento válida.',
        ]);

        User::create([
            'name'             => $req->name,
            'email'            => $req->email,
            'password'         => Hash::make($req->password),
            'data_nascimento'  => $req->data_nascimento,
        ]);

        return redirect()->route('login.show')
                         ->with('mensagem', 'Cadastro realizado com sucesso.');
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
            'name'            => 'required|string|max:255',
            'data_nascimento' => 'nullable|date',
            'tipo'            => 'required|in:leitor,criador,admin',
        ], [
            'name.required'            => 'O campo nome é obrigatório.',
            'data_nascimento.date'     => 'Informe uma data de nascimento válida.',
        ]);

        $user->update([
            'name'             => $req->name,
            'data_nascimento'  => $req->data_nascimento,
            'tipo_conta'       => $req->tipo,
        ]);

        return back()->with('mensagem', 'Perfil atualizado com sucesso.');
    }
}
