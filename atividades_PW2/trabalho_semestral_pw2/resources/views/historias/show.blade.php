@extends('layouts.app')

@section('bg-url', 'https://i.imgur.com/ZYYKS4c.png')

@section('content')
<div style="max-width:800px; margin:30px auto;">
    <button onclick="history.back()" class="btn-acao" style="margin-bottom:20px;">Voltar</button>

    <h2>{{ $post->titulo }}</h2>
    <p>{{ $post->texto }}</p>

    @if($post->imagem1)
        <img src="{{ $post->imagem1 }}" alt="" style="max-width:100%; margin:15px 0;">
    @endif
    @if($post->imagem2)
        <img src="{{ $post->imagem2 }}" alt="" style="max-width:100%; margin:15px 0;">
    @endif
    @if($post->imagem3)
        <img src="{{ $post->imagem3 }}" alt="" style="max-width:100%; margin:15px 0;">
    @endif

    @if($post->video)
        <div style="margin:20px 0;">
            <iframe 
                width="100%" 
                height="315" 
                src="{{ $post->video }}" 
                frameborder="0" 
                allowfullscreen>
            </iframe>
        </div>
    @endif

    @if($post->musica)
        <div style="margin:20px 0;">
            <audio controls src="{{ $post->musica }}"></audio>
        </div>
    @endif

    <p><strong>Fonte:</strong> {{ $post->fonte }}</p>
    <p><strong>Palavras-chave:</strong> 
        {{ $post->palavra_chave1 }} 
        {{ $post->palavra_chave2 }} 
        {{ $post->palavra_chave3 }}
    </p>

    @auth
        <form method="POST" action="{{ route('avaliacoes.store', $post->id) }}" style="margin-top:20px;">
            @csrf
            <label>Nota:</label>
            <input type="number" name="nota" min="0" max="10" required style="width:60px; margin-left:10px;">
            <button class="btn-acao" style="margin-left:10px;">Avaliar</button>
        </form>
    @endauth
</div>
@endsection
