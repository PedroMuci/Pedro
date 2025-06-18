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
                            <button type="submit" class="btn-delete"
                                onclick="return confirm('Tem certeza que deseja excluir esta avaliação?')">
                                Excluir
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('toggle-form').addEventListener('click', function () {
    const f = document.getElementById('avaliacao-form');
    f.classList.toggle('form-hidden');
    f.reset();
    document.getElementById('avaliacao_id').value = '';
    f.action = '{{ route("avaliacoes.store") }}';
    f.querySelector('input[name="_method"]').value = 'POST';
});

document.querySelectorAll('.btn-edit').forEach(button => {
    button.addEventListener('click', function () {
        const f = document.getElementById('avaliacao-form');
        f.classList.remove('form-hidden');
        f.nota.value = this.dataset.nota;
        f.user_id.value = this.dataset.user_id;
        f.postagem_id.value = this.dataset.postagem_id;
        document.getElementById('avaliacao_id').value = this.dataset.id;
        f.action = `/avaliacoes/${this.dataset.id}`;
        f.querySelector('input[name="_method"]').value = 'PUT';
    });
});
</script>
@endpush
