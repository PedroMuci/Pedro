@extends('layouts.app')

@section('title', 'Editar Postagem')

@section('content')
<div style="max-width:600px; margin:30px auto;">
    <h2 style="text-align:center; margin-bottom:30px;">Editar Postagem</h2>

    @if ($errors->any())
        <div style="background:#FFCDD2; padding:10px; margin-bottom:20px; border-radius:6px;">
            <ul style="margin:0; padding-left:20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('gerenciar.update', $post->id) }}">
        @csrf
        @method('PUT')

        <input type="text" name="titulo" value="{{ old('titulo', $post->titulo) }}" placeholder="Título" required>

        <textarea name="texto" placeholder="Conteúdo" required style="height:150px;">{{ old('texto', $post->texto) }}</textarea>

        <input type="url" name="imagem1" value="{{ old('imagem1', $post->imagem1) }}" placeholder="URL da Imagem 1 (obrigatório)" required>
        <input type="url" name="imagem2" value="{{ old('imagem2', $post->imagem2) }}" placeholder="URL da Imagem 2 (opcional)">
        <input type="url" name="imagem3" value="{{ old('imagem3', $post->imagem3) }}" placeholder="URL da Imagem 3 (opcional)">

        <input type="url" name="video" value="{{ old('video', $post->video) }}" placeholder="URL do Vídeo (opcional)">
        <input type="url" name="musica" value="{{ old('musica', $post->musica) }}" placeholder="URL da Música (opcional)">

        <input type="text" name="fonte" value="{{ old('fonte', $post->fonte) }}" placeholder="Fonte (obrigatório)" required>

        <input type="text" name="palavra_chave1" value="{{ old('palavra_chave1', $post->palavra_chave1) }}" placeholder="Palavra-chave 1">
        <input type="text" name="palavra_chave2" value="{{ old('palavra_chave2', $post->palavra_chave2) }}" placeholder="Palavra-chave 2">
        <input type="text" name="palavra_chave3" value="{{ old('palavra_chave3', $post->palavra_chave3) }}" placeholder="Palavra-chave 3">

        <button type="submit" class="btn-acao" style="width:100%; margin-top:20px;">
            Salvar Alterações
        </button>
    </form>
    <div style="text-align:center; margin-top:30px;">
        <a href="{{ route('gerenciar.index') }}" class="btn-acao" style="
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 999;"
        >
            ← Voltar
        </a>
    </div>
</div>
@endsection
