@extends('layouts.app')

@section('content')
<div style="max-width:800px; margin:30px auto;">
    <h2>Administração</h2>

    <h3>Postagens Pendentes</h3>
    @foreach($posts as $post)
        <div style="background:rgba(255,255,255,0.8); padding:15px; margin-bottom:20px; border-radius:8px;">
            <h4>{{ $post->titulo }}</h4>
            <form method="POST" action="{{ route('admin.aprovarPostagem', $post->id) }}" style="display:inline;">
                @csrf
                <button class="btn-acao">Aprovar</button>
            </form>
            <form method="POST" action="{{ route('admin.devolverPostagem', $post->id) }}" style="display:inline; margin-left:10px;">
                @csrf
                <input type="text" name="mensagem_devolucao" placeholder="Motivo" required style="padding:6px;">
                <button class="btn-acao" style="background:#FFB74D;border-color:#FFB74D;">Devolver</button>
            </form>
            <form method="POST" action="{{ route('admin.excluirPostagem', $post->id) }}" style="display:inline; margin-left:10px;">
                @csrf
                <button class="btn-acao" style="background:#E57373;border-color:#E57373;">Excluir</button>
            </form>
        </div>
    @endforeach

    <h3>Solicitações de Admin</h3>
    @foreach($solicitacoes as $s)
        <div style="background:rgba(255,255,255,0.8); padding:15px; margin-bottom:20px; border-radius:8px;">
            <p><strong>{{ $s->user->name }}</strong> solicitou acesso de administrador.</p>
            <form method="POST" action="{{ route('admin.aprovarSolicitacao', $s->id) }}" style="display:inline;">
                @csrf
                <button class="btn-acao">Aprovar</button>
            </form>
            <form method="POST" action="{{ route('admin.negarSolicitacao', $s->id) }}" style="display:inline; margin-left:10px;">
                @csrf
                <button class="btn-acao" style="background:#E57373;border-color:#E57373;">Negar</button>
            </form>
        </div>
    @endforeach
</div>
@endsection
