@extends('layouts.app')

@section('header-icon')
<div class="header-with-icon">
    <img src="{{ asset('images/icones/3817911.png') }}" alt="Ícone Usuários">
    <div>
        <h1>Gerenciar Usuários</h1>
        <p class="subtitle">Adicione, edite ou remova contas de usuários no sistema.</p>
    </div>
</div>
@endsection

@section('main-content')
<button id="toggle-form" class="btn-primary">Adicionar Novo Usuário</button>

<form id="usuario-form" class="form-hidden" method="POST" action="{{ route('usuarios.store') }}">
    @csrf
    <input type="hidden" name="usuario_id" id="usuario_id">
    @method('POST')

    <div class="form-grid">
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div class="form-group">
            <label for="tipo">Tipo de Conta:</label>
            <select name="tipo" id="tipo">
                <option value="admin">Administrador</option>
                <option value="comum">Comum</option>
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
            <th>E-mail</th>
            <th>Tipo</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($usuarios as $usuario)
        <tr>
            <td>{{ $usuario->id }}</td>
            <td>{{ $usuario->name }}</td>
            <td>{{ $usuario->email }}</td>
            <td>{{ $usuario->tipo }}</td>
            <td>
                <button class="btn-edit"
                    data-id="{{ $usuario->id }}"
                    data-name="{{ $usuario->name }}"
                    data-email="{{ $usuario->email }}"
                    data-tipo="{{ $usuario->tipo }}"
                >Editar</button>

                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    document.getElementById('toggle-form').addEventListener('click', function () {
        const form = document.getElementById('usuario-form');
        form.classList.toggle('form-hidden');
        form.reset();
        document.getElementById('usuario_id').value = '';
        form.action = '{{ route("usuarios.store") }}';
        form.querySelector('input[name="_method"]').value = 'POST';
    });

    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function () {
            const form = document.getElementById('usuario-form');
            form.classList.remove('form-hidden');

            form.name.value = this.dataset.name;
            form.email.value = this.dataset.email;
            form.tipo.value = this.dataset.tipo;

            document.getElementById('usuario_id').value = this.dataset.id;
            form.action = `/usuarios/${this.dataset.id}`;
            form.querySelector('input[name="_method"]').value = 'PUT';
        });
    });
</script>
@endsection
