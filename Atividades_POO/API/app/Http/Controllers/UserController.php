<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'data_nascimento' => 'required|date',
            'tipo_conta' => 'required|in:leitor,criador,admin',
        ]);

        User::create($data);
        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso.');
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'data_nascimento' => 'required|date',
            'tipo_conta' => 'required|in:leitor,criador,admin',
        ]);

        $usuario->update($data);
        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('users.index')->with('success', 'Usuário deletado com sucesso.');
    }
}
