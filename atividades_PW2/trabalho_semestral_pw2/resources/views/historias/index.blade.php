@extends('layouts.app')

@section('content')
    <style>
        main {
            align-items: flex-start !important;
            justify-content: flex-start !important;
        }
    </style>

    <header style="
        width: 100%;
        max-width: 1000px;
        margin: 20px auto 0;
        padding: 20px;
        background: #FAF9F5;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 1;
    ">
        <h1 style="
            font-family: serif;
            font-size: 3em;
            color: #3E2723;
            text-align: center;
            margin: 0 0 15px;
        ">Histórias Perdidas</h1>

        <form method="GET" action="{{ route('historias.index') }}" style="text-align:center;">
            <input
                type="text"
                name="busca"
                placeholder="Pesquisar..."
                value="{{ request('busca') }}"
                style="
                    width: 60%;
                    max-width: 400px;
                    padding: 12px 16px;
                    font-size: 1em;
                    border: 2px solid #A33617;
                    border-radius: 20px;
                    box-sizing: border-box;
                "
            >
        </form>
    </header>

    @if($posts->isEmpty())
        <div style="
            width:100%;
            min-height:60vh;
            display:flex;
            align-items:center;
            justify-content:center;
            z-index: 0;
        ">
            <p style="color:#8D6E63; font-size:1.2em;">
                Nenhuma história encontrada.
            </p>
        </div>
    @else
        <div style="
            width:100%;
            max-width:1000px;
            min-height:60vh;
            margin:40px auto 60px;
            display: flex;
            flex-wrap: wrap;
            gap:30px;
            justify-content: center;
            align-items: center;
            z-index: 0;
        ">
            @foreach($posts as $post)
                <div style="
                    width:280px;
                    background:#FFFFFF;
                    border:2px solid #A33617;
                    border-radius:12px;
                    overflow:hidden;
                    box-shadow:0 4px 8px rgba(0,0,0,0.1);
                    display:flex;
                    flex-direction:column;
                    max-height:430px;
                ">
                    @if($post->imagem1)
                        <div style="flex:0 0 150px; overflow:hidden;">
                            <img src="{{ asset($post->imagem1) }}"
                                 onerror="this.src='https://via.placeholder.com/300x180?text=Imagem+Indisponível'"
                                 alt="{{ $post->titulo }}"
                                 style="width:100%; height:100%; object-fit:cover;">
                        </div>
                    @endif

                    <div style="flex:1; padding:15px; display:flex; flex-direction:column;">
                        <h3 style="
                            font-size:1.2em;
                            margin:0 0 10px;
                            color:#3E2723;
                        ">{{ \Illuminate\Support\Str::limit($post->titulo, 40) }}</h3>
                        <p style="
                            font-size:0.95em;
                            color:#5D4037;
                            line-height:1.4;
                            margin:0 0 15px;
                            flex:1;
                        ">
                            {{ \Illuminate\Support\Str::limit($post->texto, 80, '...') }}
                        </p>
                        <button
                            type="button"
                            class="btn-acao"
                            style="margin-top:auto;"
                            onclick="location.href='{{ route('historias.show', $post->id) }}'"
                        >
                            Ler Mais
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
