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
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo" required>
            </div>

            <div class="form-group">
                <label for="texto">Texto:</label>
                <textarea name="texto" id="texto" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="imagem1">Imagem 1 (URL):</label>
                <input type="url" name="imagem1" id="imagem1">
            </div>

            <div class="form-group">
                <label for="imagem2">Imagem 2 (URL):</label>
                <input type="url" name="imagem2" id="imagem2">
            </div>

            <div class="form-group">
                <label for="imagem3">Imagem 3 (URL):</label>
                <input type="url" name="imagem3" id="imagem3">
            </div>

            <div class="form-group">
                <label for="video">Vídeo (URL):</label>
                <input type="url" name="video" id="video">
            </div>

            <div class="form-group">
                <label for="musica">Música (URL):</label>
                <input type="url" name="musica" id="musica">
            </div>

            <div class="form-group">
                <label for="fonte">Fonte:</label>
                <input type="text" name="fonte" id="fonte">
            </div>

            <div class="form-group">
                <label for="palavra_chave1">Palavra-chave 1:</label>
                <input type="text" name="palavra_chave1" id="palavra_chave1">
            </div>

            <div class="form-group">
                <label for="palavra_chave2">Palavra-chave 2:</label>
                <input type="text" name="palavra_chave2" id="palavra_chave2">
            </div>

            <div class="form-group">
                <label for="palavra_chave3">Palavra-chave 3:</label>
                <input type="text" name="palavra_chave3" id="palavra_chave3">
            </div>

            <div class="form-group">
                <label for="user_id">ID do Usuário:</label>
                <input type="number" name="user_id" id="user_id" required>
            </div>
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

<style>
    .usuario-container { margin-top: 2rem; }
    .header-with-icon {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
    }
    .header-with-icon img {
        height: 64px;
        width: auto;
    }
    .btn-primary {
        background: #2563eb;
        color: white;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        margin-bottom: 1.5rem;
    }
    .form-hidden {
        display: none;
        margin-bottom: 2rem;
        background: var(--card-bg);
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
    }
    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
    }
    .btn-submit {
        margin-top: 1rem;
        padding: 0.75rem 1.5rem;
        background: #10b981;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
    }
    table.usuarios-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
        background: var(--card-bg);
        border-radius: 12px;
        overflow: hidden;
    }
    table.usuarios-table th,
    table.usuarios-table td {
        padding: 0.75rem 1rem;
        text-align: left;
        border-bottom: 1px solid var(--border-color);
    }
    h2 {
        font-size: 1.25rem;
        font-weight: 700;
        margin-top: 3rem;
    }
    @media (max-width: 600px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

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
