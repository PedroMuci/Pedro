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
        <input type="hidden" name="usuario_id" id="usuario_id">
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
                            <button type="submit" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<style>
    .usuario-container {
        margin-top: 2rem;
    }

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
    .form-group select {
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
        const form = document.getElementById('usuario-form');
        form.classList.toggle('form-hidden');
        form.reset();
        document.getElementById('usuario_id').value = '';
        form.action = '{{ route("users.store") }}';
        const method = form.querySelector('input[name="_method"]');
        if (method) {
            method.value = 'POST';
        }
    });

    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function () {
            const form = document.getElementById('usuario-form');
            form.classList.remove('form-hidden');

            const id = this.dataset.id;
            const name = this.dataset.name;
            const email = this.dataset.email;
            const nascimento = this.dataset.data_nascimento;
            const tipo = this.dataset.tipo_conta;

            document.getElementById('name').value = name;
            document.getElementById('email').value = email;
            document.getElementById('data_nascimento').value = nascimento;
            document.getElementById('tipo_conta').value = tipo;
            document.getElementById('usuario_id').value = id;

            form.action = `/users/${id}`;
            let method = form.querySelector('input[name="_method"]');
            if (!method) {
                method = document.createElement('input');
                method.setAttribute('type', 'hidden');
                method.setAttribute('name', '_method');
                form.appendChild(method);
            }
            method.value = 'PUT';
        });
    });
</script>
@endsection
