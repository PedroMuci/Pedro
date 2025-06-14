@extends('layouts.app')

@section('bg-url', 'https://i.imgur.com/ZYYKS4c.png')

@section('content')
<div style="max-width:800px; margin:30px auto;">

    <div style="
        background: rgba(255,255,255,0.9);
        border: 2px solid #A33617;
        border-radius:12px;
        padding:30px;
        box-shadow:0 4px 8px rgba(0,0,0,0.1);
        max-height: 80vh;
        overflow-y: auto;
    ">
        <h2 style="
            font-family: serif;
            font-size:2.5em;
            color:#3E2723;
            margin-bottom:10px;
            text-align: center;
            border-bottom:2px solid #A33617;
            padding-bottom:10px;
            word-break: break-word;
            overflow-wrap: break-word;
        ">
            {{ $post->titulo }}
        </h2>

        <p style="
            font-size:1.1em;
            line-height:1.6;
            color:#5D4037;
            margin-bottom:20px;
            text-align:justify;
            word-break: break-word;
            overflow-wrap: break-word;
        ">
            {{ $post->texto }}
        </p>

        @foreach (['imagem1','imagem2','imagem3'] as $img)
            @if($post->$img)
                <div style="margin:20px 0; text-align:center;">
                    <img src="{{ asset($post->$img) }}"
                         alt="Imagem da postagem"
                         onerror="this.src='https://via.placeholder.com/600x300?text=Sem+Imagem'"
                         style="
                            max-width:100%;
                            border:2px solid #A33617;
                            border-radius:6px;
                            display:block;
                            margin: 0 auto;
                        ">
                </div>
            @endif
        @endforeach

        @if($post->video)
    @php
        preg_match('/(?:v=|youtu\.be\/)([^&\?]+)/', $post->video, $v);
        $videoId = $v[1] ?? null;
    @endphp

        @if($videoId)
            <div style="margin:20px 0; text-align:center;">
                <iframe 
                    width="100%" 
                    height="315" 
                    src="https://www.youtube.com/embed/{{ $videoId }}" 
                    frameborder="0" 
                    allowfullscreen
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    style="border:2px solid #A33617; border-radius:6px; display:block; margin:0 auto;">
                </iframe>
            </div>
            @else
                <p style="text-align:center; color:#A33617;">
                    Não foi possível carregar o vídeo.
                </p>
            @endif
        @endif


        @if($post->musica)
            <div style="
                margin:20px 0;
                padding:15px;
                border:2px solid #A33617;
                border-radius:6px;
                background: #fafafa;
            ">
                @if(\Illuminate\Support\Str::contains($post->musica, 'open.spotify.com'))
                    <iframe
                        src="{{ str_replace('track/','embed/track/',$post->musica) }}"
                        width="100%" height="80" frameborder="0"
                        allow="encrypted-media"
                        style="border:0; border-radius:6px;">
                    </iframe>

                @elseif(
                    \Illuminate\Support\Str::contains($post->musica, 'youtube.com') ||
                    \Illuminate\Support\Str::contains($post->musica, 'youtu.be') ||
                    \Illuminate\Support\Str::contains($post->musica, 'music.youtube.com')
                )
                    @php
                        preg_match('/(?:v=|youtu\.be\/)([^&\?]+)/', $post->musica, $m);
                        $videoId = $m[1] ?? null;
                    @endphp
                    @if($videoId)
                        <iframe
                            width="100%" height="315"
                            src="https://www.youtube.com/embed/{{ $videoId }}"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            style="border:0; border-radius:6px;">
                        </iframe>
                    @else
                        <p style="text-align:center; color:#A33617;">
                            Não foi possível carregar o player de música.
                        </p>
                    @endif

                @else
                    <audio controls src="{{ $post->musica }}" style="width:100%;"></audio>
                @endif
            </div>
        @endif

        <div style="margin:20px 0; font-size:0.95em; color:#5D4037;">
            <p><strong>Fonte:</strong> {{ $post->fonte }}</p>
            <p><strong>Palavras-chave:</strong> {{ $post->palavra_chave1 }} {{ $post->palavra_chave2 }} {{ $post->palavra_chave3 }}</p>
        </div>

        @auth
        <form method="POST" action="{{ route('avaliacoes.store', $post->id) }}" style="
            display:flex;
            align-items:center;
            gap:15px;
            margin:30px 0 0;
        ">
            @csrf
            <label for="nota" style="
                font-weight:bold;
                color:#3E2723;
            ">Nota:</label>
            <input 
                type="number" 
                id="nota" 
                name="nota" 
                min="0" max="10" required
                style="
                    width:80px;
                    padding:8px;
                    font-size:1em;
                    border:2px solid #A33617;
                    border-radius:6px;
                "
            >
            <button type="submit" class="btn-acao" style="padding:10px 20px; font-size:1em;">
                Avaliar
            </button>
        </form>
        @endauth
    </div>

    <div style="text-align:center; margin-top:30px;">
        <a href="{{ route('historias.index') }}" class="btn-acao" style="
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 999;
        ">
            ← Voltar
        </a>
    </div>

</div>
@endsection
