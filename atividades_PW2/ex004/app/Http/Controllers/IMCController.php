<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IMCController extends Controller
{
    public function index()
    {
        return view('imc');
    }

    public function calcular(Request $request)
    {
        $request->validate([
            'peso' => 'required|numeric|min:1',
            'altura' => 'required|numeric|min:0.5',
        ]);

        $peso = $request->peso;
        $altura = $request->altura;
        $imc = $peso / ($altura * $altura);
        $classificacao = $this->classificarIMC($imc);

        return view('imc', compact('imc', 'classificacao'));
    }

    private function classificarIMC($imc)
    {
        if ($imc < 18.5) return "Abaixo do peso";
        if ($imc < 24.9) return "Peso normal";
        if ($imc < 29.9) return "Sobrepeso";
        return "Obesidade";
    }
}
