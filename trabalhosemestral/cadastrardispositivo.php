<?php
session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: login.php");
    exit;
}

$conn = pg_connect("host=localhost dbname=HRAV user=postgres password=senha");
if (!$conn) {
    die("Erro ao conectar com o banco de dados.");
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_dispositivo = $_POST['id_dispositivo'];
    $novo_nome = trim($_POST['novo_nome']);

    if (empty($id_dispositivo) || empty($novo_nome)) {
        $message = "Por favor, selecione um dispositivo e insira um novo nome.";
    } else {
        $query_update = "UPDATE dispositivos SET nome_dispositivo = $1 WHERE id_dispositivo = $2";
        $result_update = pg_query_params($conn, $query_update, [$novo_nome, $id_dispositivo]);

        if ($result_update) {
            $message = "Nome do dispositivo atualizado com sucesso!";
        } else {
            $message = "Erro ao atualizar o nome do dispositivo: " . pg_last_error($conn);
        }
    }
}

$query_dispositivos = "SELECT id_dispositivo, nome_dispositivo, status FROM dispositivos";
$result_dispositivos = pg_query($conn, $query_dispositivos);

if (!$result_dispositivos) {
    die("Erro ao buscar dispositivos: " . pg_last_error($conn));
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Dispositivos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 90%;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        form {
            margin-top: 20px;
        }

        select, input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .submit-button {
            display: inline-block;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            transition: 0.3s;
            cursor: pointer;
        }

        .submit-button:hover {
            background: #0056b3;
        }

        .message {
            margin-top: 20px;
            font-size: 16px;
            font-weight: bold;
            color: #007b00;
        }

        .error {
            color: #ff0000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gerenciar Dispositivos</h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = pg_fetch_assoc($result_dispositivos)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id_dispositivo']) ?></td>
                        <td><?= htmlspecialchars($row['nome_dispositivo']) ?></td>
                        <td><?= htmlspecialchars($row['status'] ? 'Ativo' : 'Inativo') ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <form method="POST" action="cadastrardispositivo.php">
            <label for="id_dispositivo">Selecione um dispositivo:</label>
            <select id="id_dispositivo" name="id_dispositivo" required>
                <option value="">Selecione</option>
                <?php
                pg_result_seek($result_dispositivos, 0);
                while ($row = pg_fetch_assoc($result_dispositivos)): ?>
                    <option value="<?= htmlspecialchars($row['id_dispositivo']) ?>">
                        <?= htmlspecialchars($row['id_dispositivo']) ?> - <?= htmlspecialchars($row['nome_dispositivo']) ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label for="novo_nome">Novo nome para o dispositivo:</label>
            <input type="text" id="novo_nome" name="novo_nome" placeholder="Digite o novo nome" required>

            <button type="submit" class="submit-button">Atualizar Nome</button>
        </form>

        <?php if (!empty($message)): ?>
            <div class="message <?= strpos($message, 'Erro') === false ? '' : 'error' ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <a href="central_de_comando.php" class="submit-button" style="margin-top: 20px;">Voltar</a>
    </div>
</body>
</html>
<?php
pg_close($conn);
?>
