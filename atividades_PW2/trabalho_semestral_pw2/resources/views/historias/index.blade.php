@extends('layouts.app')

@section('content')
    <style>
        main {
            align-items: flex-start !important;
            justify-content: flex-start !important;
        }
        .historia-header {
            width: 100%;
            max-width: 1000px;
            margin: 20px auto 120px;
            padding: 40px;
            background: #FAF9F5;
            position: relative;
            z-index: 1;
        }
        .historia-grid {
            width:100%;
            max-width:1000px;
            margin:0 auto 60px;
            display: flex;
            flex-wrap: wrap;
            gap:30px;
            justify-content: center;
            align-items: stretch;
            z-index: 0;
        }
        .historia-card {
            width:280px;
            background:#FFFFFF;
            border:2px solid #A33617;
            border-radius:12px;
            overflow:hidden;
            box-shadow:0 4px 8px rgba(0,0,0,0.1);
            display:flex;
            flex-direction:column;
        }
        .historia-card img {
            width:100%; height:100%; object-fit:cover;
        }
        .historia-card-content {
            flex:1;
            padding:15px;
            display:flex;
            flex-direction:column;
        }
        .historia-nota {
            text-align:center;
            padding:8px;
            background:#FFF5F0;
            border-bottom:1px solid #A33617;
        }
    </style>

    {{-- Cabeçalho --}}
    <header class="historia-header">
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
        ">
            <p style="color:#8D6E63; font-size:1.2em;">
                Nenhuma história encontrada.
            </p>
        </div>
    @else
        <div class="historia-grid">
            @foreach($posts as $post)
                @php
                    $media = $post->avaliacoes->avg('nota');
                @endphp

                <div class="historia-card">
                    {{-- Nota média ou N/A --}}
                    <div class="historia-nota">
                        @if(is_null($media))
                            <strong style="color:#A33617;">N/A</strong>
                        @else
                            <strong style="color:#A33617;">{{ round($media, 1) }} / 10</strong>
                        @endif
                    </div>


                    @if($post->imagem1)
                        <div style="flex:0 0 150px; overflow:hidden;">
                            <img
                                src="{{ asset($post->imagem1) }}"
                                onerror="this.src='https://via.placeholder.com/300x180?text=Imagem+Indispon%C3%ADvel'"
                                alt="{{ $post->titulo }}"
                            >
                        </div>
                    @endif

                    <div class="historia-card-content">
                        {{-- Título --}}
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

                        {{-- Botão Ler Mais --}}
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

    {{-- Voltar ao menu --}}
    <div style="text-align:center; margin-top:30px;">
        <a href="{{ route('menu') }}" class="btn-acao" style="
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 999;
        ">
            ← Voltar
        </a>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.historia-card');
            let maxH = 0;
            cards.forEach(c => {
                const h = c.offsetHeight;
                if (h > maxH) maxH = h;
            });
            cards.forEach(c => c.style.height = maxH + 'px');
        });
    </script>
@endsection
