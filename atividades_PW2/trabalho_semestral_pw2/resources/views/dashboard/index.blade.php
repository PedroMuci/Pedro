@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div style="max-width: 800px; width: 100%; background-color: white; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); padding: 40px 30px;">

    <h2 style="text-align: center; font-size: 28px; color: #3E2723; margin-bottom: 10px;">Dashboard</h2>
    <p style="text-align: center; font-style: italic; color: #5f3c2b; margin-bottom: 30px;">
        Total de Usuários: {{ $countUsers }} | Postagens: {{ $countPosts }} | Avaliações: {{ $countReviews }}
    </p>

    {{-- Botões principais --}}
    <div style="border: 1px solid #A33617; border-radius: 10px; padding: 20px; background-color: #fff1ec; margin-bottom: 30px;">
        <form method="POST" action="{{ route('admin.dashboard.deleteAllUsuarios') }}" style="margin-bottom: 15px;">
            @csrf @method('DELETE')
            <input type="submit" value="Excluir TODOS os Usuários" class="btn-acao" style="width: 100%;">
        </form>

        <form method="POST" action="{{ route('admin.dashboard.deleteAllPostagens') }}" style="margin-bottom: 15px;">
            @csrf @method('DELETE')
            <input type="submit" value="Excluir TODAS as Postagens" class="btn-acao" style="width: 100%;">
        </form>

        <form method="POST" action="{{ route('admin.dashboard.deleteAllAvaliacoes') }}">
            @csrf @method('DELETE')
            <input type="submit" value="Excluir TODAS as Avaliações" class="btn-acao" style="width: 100%;">
        </form>
    </div>

    {{-- Lista de Usuários --}}
    <div style="margin-bottom: 30px;">
        <h3 style="font-size: 20px; color: #3E2723; margin-bottom: 10px;">Usuários</h3>
        @forelse($users as $user)
            <div style="display: flex; justify-content: space-between; align-items: flex-start; padding: 12px; border: 1px solid #ccc; border-radius: 8px; margin-bottom: 10px;">
                <span style="max-width: 75%; word-wrap: break-word;">
                    {{ $user->nome }} ({{ $user->email }})
                </span>
                <form method="POST" action="{{ route('admin.dashboard.deleteUsuario', $user->id) }}">
                    @csrf @method('DELETE')
                    <input type="submit" value="Remover" class="btn-acao" style="padding: 8px 12px; font-size: 0.9em;">
                </form>
            </div>
        @empty
            <p style="color: #666;">Nenhum usuário encontrado.</p>
        @endforelse
    </div>

    {{-- Lista de Postagens --}}
    <div style="margin-bottom: 30px;">
        <h3 style="font-size: 20px; color: #3E2723; margin-bottom: 10px;">Postagens</h3>
        @forelse($posts as $post)
            <div style="display: flex; justify-content: space-between; align-items: flex-start; padding: 12px; border: 1px solid #ccc; border-radius: 8px; margin-bottom: 10px;">
                <span style="max-width: 75%; word-wrap: break-word;">
                    {{ $post->titulo }}
                </span>
                <form method="POST" action="{{ route('admin.dashboard.deletePostagem', $post->id) }}">
                    @csrf @method('DELETE')
                    <input type="submit" value="Remover" class="btn-acao" style="padding: 8px 12px; font-size: 0.9em;">
                </form>
            </div>
        @empty
            <p style="color: #666;">Nenhuma postagem encontrada.</p>
        @endforelse
    </div>

    {{-- Lista de Avaliações --}}
    <div style="margin-bottom: 30px;">
        <h3 style="font-size: 20px; color: #3E2723; margin-bottom: 10px;">Avaliações</h3>
        @forelse($reviews as $review)
            <div style="display: flex; justify-content: space-between; align-items: flex-start; padding: 12px; border: 1px solid #ccc; border-radius: 8px; margin-bottom: 10px;">
                <span style="max-width: 75%; word-wrap: break-word;">
                    {{ $review->comentario }} (Nota: {{ $review->nota }})
                </span>
                <form method="POST" action="{{ route('admin.dashboard.deleteAvaliacao', $review->id) }}">
                    @csrf @method('DELETE')
                    <input type="submit" value="Remover" class="btn-acao" style="padding: 8px 12px; font-size: 0.9em;">
                </form>
            </div>
        @empty
            <p style="color: #666;">Nenhuma avaliação encontrada.</p>
        @endforelse
    </div>

    {{-- Botão Voltar --}}
    <div style="text-align:center; margin-top:30px;">
        <a href="{{ route('admin.index') }}" class="btn-acao" style="
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
