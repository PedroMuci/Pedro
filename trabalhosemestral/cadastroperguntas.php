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
    $texto_pergunta = trim($_POST['texto_pergunta']);
    $id_setor = $_POST['id_setor'];

    if (empty($texto_pergunta) || empty($id_setor)) {
        $message = "Por favor, preencha todos os campos.";
    } else {
        $query_max_id = "SELECT COALESCE(MAX(id_pergunta), 0) + 1 AS next_id FROM perguntas";
        $result_max_id = pg_query($conn, $query_max_id);

        if ($result_max_id) {
            $row = pg_fetch_assoc($result_max_id);
            $next_id = $row['next_id'];

            $query_insert = "INSERT INTO perguntas (id_pergunta, texto_pergunta, id_setor, status) VALUES ($1, $2, $3, TRUE)";
            $result_insert = pg_query_params($conn, $query_insert, [$next_id, $texto_pergunta, $id_setor]);

            if ($result_insert) {
                $message = "Pergunta cadastrada com sucesso!";
            } else {
                $message = "Erro ao cadastrar a pergunta: " . pg_last_error($conn);
            }
        } else {
            $message = "Erro ao obter o próximo ID: " . pg_last_error($conn);
        }
    }
}

pg_close($conn);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Nova Pergunta</title>
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
            max-width: 500px;
            width: 90%;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
            font-weight: bold;
        }

        input[type="text"],
        select {
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
        <h1>Cadastrar Nova Pergunta</h1>
        <form method="POST" action="cadastroperguntas.php">
            <label for="texto_pergunta">Texto da Pergunta:</label>
            <input type="text" id="texto_pergunta" name="texto_pergunta" placeholder="Digite o texto da pergunta" required>

            <label for="id_setor">Setor:</label>
            <select id="id_setor" name="id_setor" required>
                <option value="">Selecione um setor</option>
                <option value="1">Atendimento</option>
                <option value="2">Enfermaria</option>
                <option value="3">Organização</option>
                <option value="4">Diagnóstico</option>
                <option value="5">Tecnologia</option>
            </select>

            <button type="submit" class="submit-button">Cadastrar Pergunta</button>
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
