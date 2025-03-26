<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViagemController extends Controller
{
    public function index()
    {
        return view('viagem');
    }

    public function calcular(Request $request)
    {
        $request->validate([
            'distancia' => 'required|numeric|min:1',
            'consumo' => 'required|numeric|min:1',
            'preco_combustivel' => 'required|numeric|min:0.1',
        ]);

        $distancia = $request->distancia;
        $consumo = $request->consumo;
        $preco = $request->preco_combustivel;

        $custo = ($distancia / $consumo) * $preco;

        return view('viagem', compact('distancia', 'consumo', 'preco', 'custo'));
    }
}
