<?php

namespace App\Http\Controllers;

use App\Models\TipoContato;
use Illuminate\Http\Request;

class TipoContatoController extends Controller
{
 
    public function index()
    {
        $tipos = TipoContato::all();
        return view('tipocontato.index', compact('tipos'));
    }

   
    public function create()
    {
        return view('tipocontato.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        TipoContato::create($request->all());
        return redirect()->route('tipocontato.index')->with('success', 'Tipo de contato criado com sucesso!');
    }


    public function edit($id)
    {
        $tipo = TipoContato::findOrFail($id);
        return view('tipocontato.edit', compact('tipo'));
    }

 
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $tipo = TipoContato::findOrFail($id);
        $tipo->update($request->all());
        return redirect()->route('tipocontato.index')->with('success', 'Tipo de contato atualizado com sucesso!');
    }

 
    public function destroy($id)
    {
        $tipo = TipoContato::findOrFail($id);
        $tipo->delete();
        return redirect()->route('tipocontato.index')->with('success', 'Tipo de contato excluído com sucesso!');
    }
}