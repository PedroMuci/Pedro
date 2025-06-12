@extends('layouts.app')

@section('title', 'Administração')

@section('content')
<style>
    .admin-container {
        max-width: 900px;
        margin: 40px auto;
        background: #fffefc;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .section-title {
        margin-bottom: 15px;
        border-bottom: 2px solid #b54c26;
        padding-bottom: 5px;
        color: #6e2e15;
    }
    .card {
        background: #fffaf5;
        border: 1px solid #e3d5ca;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
    }
    .card h4 {
        margin: 0 0 10px;
        color: #3e2723;
    }
    .card .actions {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin-top: 10px;
    }
    .empty-box {
        padding: 20px;
        text-align: center;
        background: #fdf6f0;
        border: 1px dashed #e0c3aa;
        border-radius: 8px;
        color: #a0693d;
        font-style: italic;
    }
    .btn-acao {
        flex: 1;
        padding: 8px 0;
        background: #b54c26;
        border: 1px solid #b54c26;
        color: white;
        border-radius: 5px;
        text-align: center;
        cursor: pointer;
        transition: opacity 0.2s;
    }
    .btn-acao:hover {
        opacity: 0.9;
    }
</style>

<div class="admin-container">
    <h2 class="section-title">Administração</h2>

    {{-- Postagens Pendentes --}}
    <h3 class="section-title">Postagens Pendentes</h3>
    @if($posts->isEmpty())
        <div class="empty-box">
            Nenhuma postagem pendente no momento.
        </div>
    @else
        @foreach($posts as $post)
            <div class="card">
                <h4>{{ $post->titulo }}</h4>
                <div class="actions">
                    {{-- Aprovar --}}
                    <form method="POST" action="{{ route('admin.aprovarPostagem', $post->id) }}">
                        @csrf
                        <button type="submit" class="btn-acao">Aprovar</button>
                    </form>
                    {{-- Editar --}}
                    <a href="{{ route('admin.editarPostagem', $post->id) }}" class="btn-acao">Editar</a>
                    {{-- Excluir --}}
                    <form method="POST" action="{{ route('admin.excluirPostagem', $post->id) }}">
                        @csrf
                        <button type="submit" class="btn-acao">Excluir</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif

    {{-- Solicitações de Admin --}}
    <h3 class="section-title" style="margin-top:40px;">Solicitações de Admin</h3>
    @if($solicitacoes->isEmpty())
        <div class="empty-box">
            Nenhuma solicitação de administrador no momento.
        </div>
    @else
        @foreach($solicitacoes as $s)
            <div class="card">
                <p><strong>{{ $s->user->name }}</strong> solicitou acesso de administrador.</p>
                <div class="actions">
                    {{-- Aprovar solicitação --}}
                    <form method="POST" action="{{ route('admin.aprovarSolicitacao', $s->id) }}">
                        @csrf
                        <button type="submit" class="btn-acao">Aprovar</button>
                    </form>
                    {{-- Negar solicitação --}}
                    <form method="POST" action="{{ route('admin.negarSolicitacao', $s->id) }}">
                        @csrf
                        <button type="submit" class="btn-acao">Negar</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
