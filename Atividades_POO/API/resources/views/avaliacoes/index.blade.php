@extends('layouts.app')

@section('content')
<div class="usuario-container">
    <div class="header-with-icon">
        <img src="{{ asset('images/icones/6595788.png') }}" alt="Ícone Avaliações">
        <div>
            <h1>Gerenciar Avaliações</h1>
            <p class="subtitle">Crie, edite ou remova avaliações de postagens.</p>
        </div>
    </div>

    <button id="toggle-form" class="btn-primary">Adicionar Nova Avaliação</button>

    <form id="avaliacao-form" class="form-hidden" method="POST" action="{{ route('avaliacoes.store') }}">
        @csrf
        <input type="hidden" name="avaliacao_id" id="avaliacao_id">
        @method('POST')

        <div class="form-grid">
            <div class="form-group">
                <label for="nota">Nota (0 a 10):</label>
                <input type="number" name="nota" id="nota" min="0" max="10" required>
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

        <button type="submit" class="btn-submit">Salvar Avaliação</button>
    </form>

    <h2>Lista de Avaliações</h2>
    <table class="usuarios-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nota</th>
                <th>Usuário</th>
                <th>Postagem</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($avaliacoes as $avaliacao)
                <tr>
                    <td>{{ $avaliacao->id }}</td>
                    <td>{{ $avaliacao->nota }}</td>
                    <td>{{ $avaliacao->user_id }}</td>
                    <td>{{ $avaliacao->postagem_id }}</td>
                    <td>
                        <button class="btn-edit"
                            data-id="{{ $avaliacao->id }}"
                            data-nota="{{ $avaliacao->nota }}"
                            data-user_id="{{ $avaliacao->user_id }}"
                            data-postagem_id="{{ $avaliacao->postagem_id }}"
                        >Editar</button>

                        <form action="{{ route('avaliacoes.destroy', $avaliacao->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir esta avaliação?')">Excluir</button>
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
</style>

<script>
    document.getElementById('toggle-form').addEventListener('click', function () {
        const form = document.getElementById('avaliacao-form');
        form.classList.toggle('form-hidden');
        form.reset();
        document.getElementById('avaliacao_id').value = '';
        form.action = '{{ route("avaliacoes.store") }}';
        form.querySelector('input[name="_method"]').value = 'POST';
    });

    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function () {
            const form = document.getElementById('avaliacao-form');
            form.classList.remove('form-hidden');

            form.nota.value = this.dataset.nota;
            form.user_id.value = this.dataset.user_id;
            form.postagem_id.value = this.dataset.postagem_id;

            document.getElementById('avaliacao_id').value = this.dataset.id;
            form.action = `/avaliacoes/${this.dataset.id}`;
            form.querySelector('input[name="_method"]').value = 'PUT';
        });
    });
</script>
@endsection
