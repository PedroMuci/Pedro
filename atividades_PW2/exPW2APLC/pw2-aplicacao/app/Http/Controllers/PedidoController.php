<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index(Request $request)
    {
        $filtro = $request->input('filtro');

        $pedidos = Pedido::with('cliente')
            ->when($filtro, function($query, $filtro) {
                return $query->where('descricao', 'ilike', "%{$filtro}%");
            })
            ->get();

        return view('pedidos.index', compact('pedidos', 'filtro'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $pedido = new Pedido(); 
            return view('pedidos.create', compact('clientes', 'pedido'));
    }


    public function store(Request $request)
    {
        Pedido::create($request->all());
        return redirect()->route('pedidos.index');
    }

    public function edit(Pedido $pedido)
    {
        $clientes = Cliente::all();
        return view('pedidos.edit', compact('pedido', 'clientes'));
    }

    public function update(Request $request, Pedido $pedido)
    {
        $pedido->update($request->all());
        return redirect()->route('pedidos.index');
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return redirect()->route('pedidos.index');
    }
}
