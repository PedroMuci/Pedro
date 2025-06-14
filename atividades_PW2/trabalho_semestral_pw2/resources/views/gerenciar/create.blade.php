@extends('layouts.app')

@section('title', 'Nova Postagem')

@section('content')
<div style="max-width:600px; margin:50px auto;">
    <h2 style="text-align:center; margin-bottom:30px;">Criar Nova Postagem</h2>

    @if ($errors->any())
        <div style="background:#FFCDD2; padding:10px; margin-bottom:20px; border-radius:6px;">
            <ul style="margin:0; padding-left:20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('gerenciar.store') }}">
        @csrf

        <input type="text" name="titulo" placeholder="Título" value="{{ old('titulo') }}" required>

        <textarea name="texto" placeholder="Conteúdo" required style="height:150px;">{{ old('texto') }}</textarea>

        <input type="url" name="imagem1" placeholder="URL da Imagem 1 (obrigatório)" value="{{ old('imagem1') }}" required>
        <input type="url" name="imagem2" placeholder="URL da Imagem 2 (opcional)" value="{{ old('imagem2') }}">
        <input type="url" name="imagem3" placeholder="URL da Imagem 3 (opcional)" value="{{ old('imagem3') }}">

        <input type="url" name="video" placeholder="URL do Vídeo (opcional)" value="{{ old('video') }}">
        <input type="url" name="musica" placeholder="URL da Música (opcional)" value="{{ old('musica') }}">

        <input type="text" name="fonte" placeholder="Fonte (obrigatório)" value="{{ old('fonte') }}" required>

        <input type="text" name="palavra_chave1" placeholder="Palavra-chave 1" value="{{ old('palavra_chave1') }}">
        <input type="text" name="palavra_chave2" placeholder="Palavra-chave 2" value="{{ old('palavra_chave2') }}">
        <input type="text" name="palavra_chave3" placeholder="Palavra-chave 3" value="{{ old('palavra_chave3') }}">

        <button type="submit" class="btn-acao" style="width:100%; margin-top:20px;">
            Publicar
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
