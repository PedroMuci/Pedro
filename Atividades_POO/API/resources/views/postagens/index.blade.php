@extends('layouts.app')

@section('content')
<div class="usuario-container">
    <div class="header-with-icon">
        <img src="{{ asset('images/icones/6301160.png') }}" alt="Ícone Postagens">
        <div>
            <h1>Gerenciar Postagens</h1>
            <p class="subtitle">Crie, edite ou remova postagens do sistema.</p>
        </div>
    </div>

    <button id="toggle-form" class="btn-primary">Adicionar Nova Postagem</button>

    <form id="postagem-form" class="form-hidden" method="POST" action="{{ route('postagens.store') }}">
        @csrf
        <input type="hidden" name="postagem_id" id="postagem_id">
        @method('POST')

        <div class="form-grid">
            @foreach ([
                'titulo' => 'Título',
                'texto' => 'Texto',
                'imagem1' => 'Imagem 1 (URL)',
                'imagem2' => 'Imagem 2 (URL)',
                'imagem3' => 'Imagem 3 (URL)',
                'video' => 'Vídeo (URL)',
                'musica' => 'Música (URL)',
                'fonte' => 'Fonte',
                'palavra_chave1' => 'Palavra-chave 1',
                'palavra_chave2' => 'Palavra-chave 2',
                'palavra_chave3' => 'Palavra-chave 3',
                'user_id' => 'ID do Usuário'
            ] as $field => $label)
                <div class="form-group">
                    <label for="{{ $field }}">{{ $label }}:</label>
                    @if ($field === 'texto')
                        <textarea name="{{ $field }}" id="{{ $field }}" rows="3"></textarea>
                    @else
                        <input
                            type="{{ in_array($field, ['imagem1','imagem2','imagem3','video','musica']) ? 'url' : ( $field === 'user_id' ? 'number' : 'text') }}"
                            name="{{ $field }}"
                            id="{{ $field }}"
                            {{ in_array($field, ['titulo', 'user_id']) ? 'required' : '' }}
                        >
                    @endif
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn-submit">Salvar Postagem</button>
    </form>

    <h2>Lista de Postagens</h2>
    <table class="usuarios-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Texto</th>
                <th>Imagens</th>
                <th>Vídeo</th>
                <th>Música</th>
                <th>Fonte</th>
                <th>Palavras-chave</th>
                <th>Usuário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($postagens as $postagem)
                <tr>
                    <td>{{ $postagem->id }}</td>
                    <td>{{ $postagem->titulo }}</td>
                    <td>{{ $postagem->texto }}</td>
                    <td>
                        @foreach ([$postagem->imagem1, $postagem->imagem2, $postagem->imagem3] as $img)
                            @if ($img)
                                <a href="{{ $img }}" target="_blank">Imagem</a><br>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @if ($postagem->video)
                            <a href="{{ $postagem->video }}" target="_blank">Vídeo</a>
                        @endif
                    </td>
                    <td>
                        @if ($postagem->musica)
                            <a href="{{ $postagem->musica }}" target="_blank">Música</a>
                        @endif
                    </td>
                    <td>{{ $postagem->fonte }}</td>
                    <td>
                        {{ $postagem->palavra_chave1 }},
                        {{ $postagem->palavra_chave2 }},
                        {{ $postagem->palavra_chave3 }}
                    </td>
                    <td>{{ $postagem->user_id }}</td>
                    <td>
                        <button class="btn-edit"
                            data-id="{{ $postagem->id }}"
                            data-titulo="{{ $postagem->titulo }}"
                            data-texto="{{ $postagem->texto }}"
                            data-imagem1="{{ $postagem->imagem1 }}"
                            data-imagem2="{{ $postagem->imagem2 }}"
                            data-imagem3="{{ $postagem->imagem3 }}"
                            data-video="{{ $postagem->video }}"
                            data-musica="{{ $postagem->musica }}"
                            data-fonte="{{ $postagem->fonte }}"
                            data-palavra_chave1="{{ $postagem->palavra_chave1 }}"
                            data-palavra_chave2="{{ $postagem->palavra_chave2 }}"
                            data-palavra_chave3="{{ $postagem->palavra_chave3 }}"
                            data-user_id="{{ $postagem->user_id }}"
                        >Editar</button>

                        <form action="{{ route('postagens.destroy', $postagem->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir esta postagem?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.getElementById('toggle-form').addEventListener('click', function () {
        const form = document.getElementById('postagem-form');
        form.classList.toggle('form-hidden');
        form.reset();
        document.getElementById('postagem_id').value = '';
        form.action = '{{ route("postagens.store") }}';
        form.querySelector('input[name="_method"]').value = 'POST';
    });

    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function () {
            const form = document.getElementById('postagem-form');
            form.classList.remove('form-hidden');

            form.titulo.value = this.dataset.titulo;
            form.texto.value = this.dataset.texto;
            form.imagem1.value = this.dataset.imagem1;
            form.imagem2.value = this.dataset.imagem2;
            form.imagem3.value = this.dataset.imagem3;
            form.video.value = this.dataset.video;
            form.musica.value = this.dataset.musica;
            form.fonte.value = this.dataset.fonte;
            form.palavra_chave1.value = this.dataset.palavra_chave1;
            form.palavra_chave2.value = this.dataset.palavra_chave2;
            form.palavra_chave3.value = this.dataset.palavra_chave3;
            form.user_id.value = this.dataset.user_id;

            document.getElementById('postagem_id').value = this.dataset.id;
            form.action = `/postagens/${this.dataset.id}`;
            form.querySelector('input[name="_method"]').value = 'PUT';
        });
    });
</script>
@endsection
