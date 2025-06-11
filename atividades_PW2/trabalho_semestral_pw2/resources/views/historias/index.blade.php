@extends('layouts.app')

@section('bg-url', 'https://i.imgur.com/ZYYKS4c.png')

@section('content')
<div style="max-width:800px; margin:30px auto;">
    <h2>Histórias Perdidas</h2>

    <form method="GET" action="{{ route('historias.index') }}" style="margin:20px 0;">
        <input 
            type="text" 
            name="busca" 
            placeholder="Pesquisar histórias..." 
            style="width:100%; padding:8px;"
            value="{{ request('busca') }}"
        >
    </form>

    @foreach($posts as $post)
        <div style="
            background: rgba(255,255,255,0.8); 
            padding: 15px; 
            margin-bottom: 20px; 
            border-radius: 8px;
        ">
            <h3>{{ $post->titulo }}</h3>
            <p>{{ \Illuminate\Support\Str::limit($post->texto, 150) }}</p>
            <a href="{{ route('historias.show', $post->id) }}" class="btn-acao">Ler Mais</a>
        </div>
    @endforeach
</div>
@endsection
