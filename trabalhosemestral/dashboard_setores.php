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

$query_setores = "SELECT s.id_setor, s.nome_setor, AVG(a.resposta) AS media
                  FROM setores s
                  LEFT JOIN perguntas p ON s.id_setor = p.id_setor
                  LEFT JOIN avaliacoes a ON p.id_pergunta = a.id_pergunta
                  WHERE s.status = TRUE
                  GROUP BY s.id_setor, s.nome_setor
                  ORDER BY s.id_setor";
$result_setores = pg_query($conn, $query_setores);

$dados_setores = [];
while ($row = pg_fetch_assoc($result_setores)) {
    $dados_setores[] = $row;
}

pg_close($conn);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Setores</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        .chart-container {
            width: 80%;
            margin: 0 auto 40px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
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
    </style>
</head>
<body>
    <h1>Dashboard de Setores</h1>
    <a href="central_de_comando.php" class="back-button">Voltar</a>
    <div class="chart-container">
        <canvas id="chartSetores"></canvas>
    </div>

    <script>
        const ctxSetores = document.getElementById('chartSetores').getContext('2d');
        const dataSetores = {
            labels: <?= json_encode(array_map(fn($d) => "#" . $d['id_setor'] . " - " . $d['nome_setor'], $dados_setores)) ?>,
            datasets: [{
                label: 'Média',
                data: <?= json_encode(array_column($dados_setores, 'media')) ?>,
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        };

        new Chart(ctxSetores, { type: 'bar', data: dataSetores });
    </script>
</body>
</html>
