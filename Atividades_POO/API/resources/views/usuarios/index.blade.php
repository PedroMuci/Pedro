@extends('layouts.app')

@section('content')
<div class="usuario-container">
    <div class="header-with-icon">
        <img src="{{ asset('images/icones/9131478.png') }}" alt="Ícone Usuários">
        <div>
            <h1>Gerenciar Usuários</h1>
            <p class="subtitle">Crie, edite ou remova usuários do sistema.</p>
        </div>
    </div>

    <button id="toggle-form" class="btn-primary">Adicionar Novo Usuário</button>

    <form id="usuario-form" class="form-hidden" method="POST" action="{{ route('users.store') }}">
        @csrf
        <input type="hidden" name="user_id" id="user_id">
        @method('POST')

        <div class="form-grid">
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" name="name" id="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" name="data_nascimento" id="data_nascimento">
            </div>

            <div class="form-group">
                <label for="tipo_conta">Tipo de Conta:</label>
                <select name="tipo_conta" id="tipo_conta">
                    <option value="leitor">Leitor</option>
                    <option value="criador">Criador</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn-submit">Salvar Usuário</button>
    </form>

    <h2>Lista de Usuários</h2>
    <table class="usuarios-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Data Nascimento</th>
                <th>Tipo Conta</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->data_nascimento }}</td>
                    <td>{{ ucfirst($usuario->tipo_conta) }}</td>
                    <td>
                        <button class="btn-edit"
                            data-id="{{ $usuario->id }}"
                            data-name="{{ $usuario->name }}"
                            data-email="{{ $usuario->email }}"
                            data-data_nascimento="{{ $usuario->data_nascimento }}"
                            data-tipo_conta="{{ $usuario->tipo_conta }}"
                        >Editar</button>

                        <form action="{{ route('users.destroy', $usuario->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete"
                                onclick="return confirm('Tem certeza que deseja excluir este usuário?')">
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
    const f = document.getElementById('usuario-form');
    f.classList.toggle('form-hidden');
    f.reset();
    document.getElementById('user_id').value = '';
    f.action = '{{ route("users.store") }}';
    f.querySelector('input[name="_method"]').value = 'POST';
});

document.querySelectorAll('.btn-edit').forEach(button => {
    button.addEventListener('click', function () {
        const f = document.getElementById('usuario-form');
        f.classList.remove('form-hidden');
        f.name.value = this.dataset.name;
        f.email.value = this.dataset.email;
        f.data_nascimento.value = this.dataset.data_nascimento;
        f.tipo_conta.value = this.dataset.tipo_conta;
        document.getElementById('user_id').value = this.dataset.id;
        f.action = `/users/${this.dataset.id}`;
        f.querySelector('input[name="_method"]').value = 'PUT';
    });
});
</script>
@endpush
