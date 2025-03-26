<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SonoController extends Controller
{
    public function index()
    {
        return view('sono');
    }

    public function avaliar(Request $request)
    {
        $request->validate([
            'horas_sono' => 'required|numeric|min:0|max:24',
        ]);

        $horas = $request->horas_sono;
        $avaliacao = $this->avaliarSono($horas);

        return view('sono', compact('horas', 'avaliacao'));
    }

    private function avaliarSono($horas)
    {
        if ($horas < 6) return "Sono insuficiente";
        if ($horas < 9) return "Sono adequado";
        return "Sono excessivo";
    }
}

