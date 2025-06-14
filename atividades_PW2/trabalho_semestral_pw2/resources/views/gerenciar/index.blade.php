@extends('layouts.app')

@section('title', 'Gerenciar Postagens')

@section('content')
<div style="max-width:800px; margin:40px auto;">
 
    <h2 style="
        font-size:2.8em;
        margin-bottom:20px;
        text-align:center;
        color:#4E342E;
    ">Gerenciar Postagens</h2>

   
    <div style="text-align:center; margin-bottom:30px;">
        <a href="{{ route('gerenciar.create') }}"
           class="btn-acao"
           style="width:200px; font-size:1.1em;">
            Nova Postagem
        </a>
    </div>

 
    @foreach($posts as $post)
        <div style="
            background: #FFFFFF;
            border: 2px solid #A33617;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        ">
           
            <h3 style="
                margin-top: 0;
                font-size:2em;
                color:#3E2723;
            ">
                {{ $post->titulo }}
            </h3>

          
            <p style="
                color:#5D4037;
                line-height:1.6;
                margin-bottom:25px;
                max-height:4.8em;
                overflow:hidden;
            ">
                {{ \Illuminate\Support\Str::limit($post->texto, 120, '...') }}
            </p>

            
            <div style="display:flex; justify-content: space-between;">
             
                <a href="{{ route('gerenciar.edit', $post->id) }}"
                   class="btn-acao"
                   style="width:120px; font-size:1em;">
                    Editar
                </a>

             
                <form method="POST"
                      action="{{ route('gerenciar.destroy', $post->id) }}"
                      onsubmit="return confirm('Deseja realmente excluir esta postagem?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="btn-acao"
                            style="width:120px; font-size:1em;">
                        Excluir
                    </button>
                </form>
            </div>
        </div>
    @endforeach

    @if($posts->isEmpty())
        <p style="
            text-align:center;
            color:#8D6E63;
            margin-top:50px;
            font-size:1.2em;
        ">
            Você ainda não tem postagens. Clique em “Nova Postagem” para começar!
        </p>
    @endif
    <div style="text-align:center; margin-top:30px;">
        <a href="{{ route('menu') }}" class="btn-acao" style="
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
