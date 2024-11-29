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

$query_perguntas = "
    SELECT p.id_pergunta, p.texto_pergunta,
           COUNT(CASE WHEN a.resposta = 0 THEN 1 END) AS nota_0,
           COUNT(CASE WHEN a.resposta = 1 THEN 1 END) AS nota_1,
           COUNT(CASE WHEN a.resposta = 2 THEN 1 END) AS nota_2,
           COUNT(CASE WHEN a.resposta = 3 THEN 1 END) AS nota_3,
           COUNT(CASE WHEN a.resposta = 4 THEN 1 END) AS nota_4,
           COUNT(CASE WHEN a.resposta = 5 THEN 1 END) AS nota_5,
           COUNT(CASE WHEN a.resposta = 6 THEN 1 END) AS nota_6,
           COUNT(CASE WHEN a.resposta = 7 THEN 1 END) AS nota_7,
           COUNT(CASE WHEN a.resposta = 8 THEN 1 END) AS nota_8,
           COUNT(CASE WHEN a.resposta = 9 THEN 1 END) AS nota_9,
           COUNT(CASE WHEN a.resposta = 10 THEN 1 END) AS nota_10,
           AVG(a.resposta) AS media
    FROM perguntas p
    LEFT JOIN avaliacoes a ON p.id_pergunta = a.id_pergunta
    WHERE p.status = TRUE
    GROUP BY p.id_pergunta, p.texto_pergunta
    ORDER BY p.id_pergunta";
$result_perguntas = pg_query($conn, $query_perguntas);

$dados_perguntas = [];
while ($row = pg_fetch_assoc($result_perguntas)) {
    $dados_perguntas[] = $row;
}

pg_close($conn);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Perguntas</title>
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

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
        }

        .chart-container {
            width: 100%;
            max-width: 800px;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            background: #fff;
        }

        .chart {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            height: 200px;
            border-left: 2px solid #333;
            border-bottom: 2px solid #333;
            padding-left: 10px;
            position: relative;
        }

        .bar {
            width: 40px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            border-radius: 5px 5px 0 0;
            transition: 0.3s;
        }

        .bar:hover {
            background-color: #0056b3;
        }

        .labels {
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
            font-size: 14px;
        }

        .media {
            text-align: right;
            margin-top: 10px;
            font-weight: bold;
            color: #555;
        }

        .back-button {
            display: block;
            margin: 0 auto 20px;
            text-align: center;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            transition: 0.3s;
            width: 150px;
        }

        .back-button:hover {
            background: #0056b3;
        }

        .y-axis-label {
            position: absolute;
            left: -35px;
            bottom: 0;
            transform: rotate(-90deg);
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Dashboard de Perguntas</h1>
    <a href="central_de_comando.php" class="back-button">Voltar</a>

    <div class="container">
        <?php foreach ($dados_perguntas as $pergunta): ?>
            <div class="chart-container">
                <h2><?= $pergunta['id_pergunta'] ?># <?= $pergunta['texto_pergunta'] ?></h2>
                <div class="chart">
                    <?php for ($i = 0; $i <= 10; $i++): ?>
                        <div class="bar" style="height: <?= $pergunta["nota_$i"] * 15 ?>px;">
                            <?= $pergunta["nota_$i"] ?>
                        </div>
                    <?php endfor; ?>
                </div>
                <div class="labels">
                    <?php for ($i = 0; $i <= 10; $i++): ?>
                        <span><?= $i ?></span>
                    <?php endfor; ?>
                </div>
                <div class="media">Média: <?= round($pergunta['media'], 2) ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
