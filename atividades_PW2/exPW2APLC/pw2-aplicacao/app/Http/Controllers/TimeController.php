<?php

namespace App\Http\Controllers;

use App\Models\Time;
use Illuminate\Http\Request;

class TimeController extends Controller
{
 public function index(Request $request)
    {
        $query = Time::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nome_clube', 'ILIKE', "%{$search}%")
                ->orWhere('apelido_clube', 'ILIKE', "%{$search}%");
            });
        }

        $times = $query->orderBy('nome_clube')->get();

        return view('times.index', compact('times'));
    }


    public function create()
    {
        return view('times.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome_clube' => 'required|string|max:255',
            'apelido_clube' => 'nullable|string|max:255',
            'escudo' => 'nullable|url',
            'ano_fundacao' => 'required|digits:4|integer|min:1800|max:' . date('Y'),
        ]);

        Time::create($data);

        return redirect()->route('times.index')->with('success', 'Time criado com sucesso.');
    }

    public function edit(Time $time)
    {
        return view('times.edit', compact('time'));
    }

    public function update(Request $request, Time $time)
    {
        $data = $request->validate([
            'nome_clube' => 'required|string|max:255',
            'apelido_clube' => 'nullable|string|max:255',
            'escudo' => 'nullable|url',
            'ano_fundacao' => 'required|digits:4|integer|min:1800|max:' . date('Y'),
        ]);

        $time->update($data);

        return redirect()->route('times.index')->with('success', 'Time atualizado com sucesso.');
    }

    public function destroy(Time $time)
    {
        $time->competicoes()->detach();
        $time->delete();

        return redirect()->route('times.index')->with('success', 'Time removido com sucesso.');
    }
}
