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

$query_feedback = "
    SELECT a.feedback_textual, p.texto_pergunta
    FROM avaliacoes a
    INNER JOIN perguntas p ON a.id_pergunta = p.id_pergunta
    WHERE a.feedback_textual IS NOT NULL AND a.feedback_textual != ''
    ORDER BY p.texto_pergunta ASC";
$result_feedback = pg_query($conn, $query_feedback);

if (!$result_feedback) {
    die("Erro ao executar a consulta: " . pg_last_error($conn));
}

$feedbacks = [];
while ($row = pg_fetch_assoc($result_feedback)) {
    $feedbacks[] = $row;
}

pg_close($conn);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedbacks</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .feedback-container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .feedback-item {
            margin-bottom: 20px;
            padding: 15px;
            border-bottom: 1px solid #ccc;
        }

        .feedback-item:last-child {
            border-bottom: none;
        }

        .question {
            font-weight: bold;
            color: #007bff;
        }

        .feedback-text {
            margin-top: 10px;
            font-style: italic;
            color: #333;
        }

        .back-button {
            display: inline-block;
            margin-top: 20px;
            text-align: center;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            transition: 0.3s;
        }

        .back-button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Feedbacks</h1>
    <div class="feedback-container">
        <?php if (count($feedbacks) > 0): ?>
            <?php foreach ($feedbacks as $feedback): ?>
                <div class="feedback-item">
                    <div class="question">Pergunta: <?= htmlspecialchars($feedback['texto_pergunta']) ?></div>
                    <div class="feedback-text">Feedback: <?= htmlspecialchars($feedback['feedback_textual']) ?></div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum feedback registrado até o momento.</p>
        <?php endif; ?>
        <a href="central_de_comando.php" class="back-button">Voltar</a>
    </div>
</body>
</html>
