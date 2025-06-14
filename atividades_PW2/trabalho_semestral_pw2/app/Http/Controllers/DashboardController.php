<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Postagem;
use App\Models\Avaliacao;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'users' => User::all(),
            'posts' => Postagem::all(),
            'reviews' => Avaliacao::all(),
            'countUsers' => User::count(),
            'countPosts' => Postagem::count(),
            'countReviews' => Avaliacao::count(),
        ]);
    }

    public function deleteUser($id)
    {
        Avaliacao::where('user_id', $id)->delete(); // Corrigido
        Postagem::where('user_id', $id)->delete();  // Corrigido
        User::destroy($id);

        return redirect()->route('dashboard.index');
    }

    public function deleteAllUsers()
    {
        Avaliacao::truncate();
        Postagem::truncate();
        User::truncate();

        return redirect()->route('dashboard.index');
    }

    public function deletePost($id)
    {
        Avaliacao::where('postagem_id', $id)->delete();
        Postagem::destroy($id);

        return redirect()->route('dashboard.index');
    }

    public function deleteAllPosts()
    {
        Avaliacao::truncate();
        Postagem::truncate();

        return redirect()->route('dashboard.index');
    }

    public function deleteReview($id) // Corrigido: nome correto do método
    {
        Avaliacao::destroy($id);
        return redirect()->route('dashboard.index');
    }

    public function deleteAllReviews() // Corrigido: nome correto do método
    {
        Avaliacao::truncate();
        return redirect()->route('dashboard.index');
    }
}
