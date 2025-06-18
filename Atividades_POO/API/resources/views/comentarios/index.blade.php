@extends('layouts.app')

@section('content')
<div class="usuario-container">
    <div class="header-with-icon">
        <img src="{{ asset('images/icones/9374926.png') }}" alt="Ícone Comentários">
        <div>
            <h1>Gerenciar Comentários</h1>
            <p class="subtitle">Crie, edite ou remova comentários de postagens.</p>
        </div>
    </div>

    <button id="toggle-form" class="btn-primary">Adicionar Novo Comentário</button>

    <form id="comentario-form" class="form-hidden" method="POST" action="{{ route('comentarios.store') }}">
        @csrf
        <input type="hidden" name="comentario_id" id="comentario_id">
        @method('POST')

        <div class="form-grid">
            <div class="form-group" style="grid-column: span 2;">
                <label for="conteudo">Conteúdo:</label>
                <input type="text" name="conteudo" id="conteudo" required>
            </div>

            <div class="form-group">
                <label for="user_id">ID do Usuário:</label>
                <input type="number" name="user_id" id="user_id" required>
            </div>

            <div class="form-group">
                <label for="postagem_id">ID da Postagem:</label>
                <input type="number" name="postagem_id" id="postagem_id" required>
            </div>
        </div>

        <button type="submit" class="btn-submit">Salvar Comentário</button>
    </form>

    <h2>Lista de Comentários</h2>
    <table class="usuarios-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Conteúdo</th>
                <th>Usuário</th>
                <th>Postagem</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comentarios as $comentario)
                <tr>
                    <td>{{ $comentario->id }}</td>
                    <td>{{ $comentario->conteudo }}</td>
                    <td>{{ $comentario->user_id }}</td>
                    <td>{{ $comentario->postagem_id }}</td>
                    <td>
                        <button class="btn-edit"
                            data-id="{{ $comentario->id }}"
                            data-conteudo="{{ $comentario->conteudo }}"
                            data-user_id="{{ $comentario->user_id }}"
                            data-postagem_id="{{ $comentario->postagem_id }}"
                        >Editar</button>

                        <form action="{{ route('comentarios.destroy', $comentario->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir este comentário?')">Excluir</button>
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
        background: var(--card-bg, #fff);
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
    .form-group input {
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
        background: var(--card-bg, #fff);
        border-radius: 12px;
        overflow: hidden;
    }
    table.usuarios-table th,
    table.usuarios-table td {
        padding: 0.75rem 1rem;
        text-align: left;
        border-bottom: 1px solid var(--border-color, #e2e8f0);
    }
    h2 {
        font-size: 1.25rem;
        font-weight: 700;
        margin-top: 3rem;
    }
    .btn-edit {
        background: #f59e0b;
        color: white;
        padding: 0.4rem 0.75rem;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        margin-right: 4px;
    }
    .btn-delete {
        background: #ef4444;
        color: white;
        padding: 0.4rem 0.75rem;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
    }
</style>

<script>
    document.getElementById('toggle-form').addEventListener('click', function () {
        const form = document.getElementById('comentario-form');
        form.classList.toggle('form-hidden');
        form.reset();
        document.getElementById('comentario_id').value = '';
        form.action = '{{ route("comentarios.store") }}';
        form.querySelector('input[name="_method"]').value = 'POST';
    });

    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function () {
            const form = document.getElementById('comentario-form');
            form.classList.remove('form-hidden');

            form.conteudo.value = this.dataset.conteudo;
            form.user_id.value = this.dataset.user_id;
            form.postagem_id.value = this.dataset.postagem_id;

            document.getElementById('comentario_id').value = this.dataset.id;
            form.action = `/comentarios/${this.dataset.id}`;
            form.querySelector('input[name="_method"]').value = 'PUT';
        });
    });
</script>
@endsection
