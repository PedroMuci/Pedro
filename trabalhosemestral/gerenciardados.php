<?php

$conn = pg_connect("host=localhost dbname=HRAV user=postgres password=senha");

if (!$conn) {
    die("<div class='message error'>Erro ao conectar com o banco de dados.</div>");
}

$message = ""; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear_evaluations'])) {
    $query_clear_evaluations = "DELETE FROM avaliacoes";
    $result = pg_query($conn, $query_clear_evaluations);

    if ($result) {
        $message = "<div class='message success'>Todas as avaliações foram removidas com sucesso.</div>";
    } else {
        $message = "<div class='message error'>Erro ao limpar as avaliações: " . pg_last_error($conn) . "</div>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_question'])) {
    $id_pergunta = $_POST['id_pergunta'] ?? null;

    if ($id_pergunta && is_numeric($id_pergunta)) {
        $query_delete_evaluations = "DELETE FROM avaliacoes WHERE id_pergunta = $1";
        pg_query_params($conn, $query_delete_evaluations, [$id_pergunta]);

        $query_delete_question = "DELETE FROM perguntas WHERE id_pergunta = $1";
        $result = pg_query_params($conn, $query_delete_question, [$id_pergunta]);

        if ($result) {
            $message = "<div class='message success'>A pergunta com ID $id_pergunta foi removida com sucesso.</div>";
        } else {
            $message = "<div class='message error'>Erro ao remover a pergunta: " . pg_last_error($conn) . "</div>";
        }
    } else {
        $message = "<div class='message error'>ID da pergunta inválido.</div>";
    }
}

pg_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Dados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        input[type="text"], button {
            font-size: 16px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-right: 10px;
        }

        button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .clear-button {
            background-color: #dc3545;
            margin-top: 20px;
        }

        .clear-button:hover {
            background-color: #b02a37;
        }

        .back-button {
            display: block;
            text-align: center;
            background: blue;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            margin: 20px auto 0;
            width: 200px;
            transition: 0.3s;
        }

        .back-button:hover {
            background-color: #5a6268;
        }

        .message {
            text-align: center;
            margin: 20px 0;
            padding: 15px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gerenciar Dados</h1>

        <?= $message ?>

        <form method="POST">
            <button type="submit" name="clear_evaluations" class="clear-button">Limpar Todas as Avaliações</button>
        </form>

        <form method="POST">
            <h2>Remover Pergunta por ID</h2>
            <input type="text" name="id_pergunta" placeholder="ID da pergunta" required>
            <button type="submit" name="remove_question">Remover Pergunta</button>
        </form>

        <a href="central_de_comando.php" class="back-button">Voltar</a>
    </div>
</body>
</html>
