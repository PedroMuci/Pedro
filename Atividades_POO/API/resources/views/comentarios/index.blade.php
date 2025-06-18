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
            <div class="form-group">
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
                            <button type="submit" class="btn-delete"
                                onclick="return confirm('Tem certeza que deseja excluir este comentário?')">
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
    const f = document.getElementById('comentario-form');
    f.classList.toggle('form-hidden');
    f.reset();
    document.getElementById('comentario_id').value = '';
    f.action = '{{ route("comentarios.store") }}';
    f.querySelector('input[name="_method"]').value = 'POST';
});

document.querySelectorAll('.btn-edit').forEach(button => {
    button.addEventListener('click', function () {
        const f = document.getElementById('comentario-form');
        f.classList.remove('form-hidden');
        f.conteudo.value = this.dataset.conteudo;
        f.user_id.value = this.dataset.user_id;
        f.postagem_id.value = this.dataset.postagem_id;
        document.getElementById('comentario_id').value = this.dataset.id;
        f.action = `/comentarios/${this.dataset.id}`;
        f.querySelector('input[name="_method"]').value = 'PUT';
    });
});
</script>
@endpush
