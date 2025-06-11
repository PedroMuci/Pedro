@extends('layouts.app')

@section('content')
<div style="max-width:600px; margin:30px auto;">
    <h2>Editar Postagem</h2>
    <form method="POST" action="{{ route('gerenciar.update', $post->id) }}">
        @csrf @method('PUT')
        <div style="margin-bottom:15px;">
            <input type="text" name="titulo" value="{{ $post->titulo }}" required style="width:100%; padding:8px;">
        </div>
        <div style="margin-bottom:15px;">
            <textarea name="texto" required style="width:100%; padding:8px; height:150px;">{{ $post->texto }}</textarea>
        </div>
        <div style="margin-bottom:15px;">
            <input type="url" name="imagem1" value="{{ $post->imagem1 }}" required style="width:100%; padding:8px;">
        </div>
        <button class="btn-acao">Salvar Alterações</button>
    </form>
</div>
@endsection
