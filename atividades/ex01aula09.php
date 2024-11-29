<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício 1 - Aula 9</title>
    <style>
        body {
            background-color: black;
            font-family: monospace;
            color: white;
            text-align: center;
        }
        form {
            margin-top: 50px;
        }
        input, button {
            margin: 5px;
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <form method="POST">
        <label for="nota1">Nota 1:</label><br>
        <input type="number" id="nota1" name="nota1" step="0.01" required><br>
        <label for="nota2">Nota 2:</label><br>
        <input type="number" id="nota2" name="nota2" step="0.01" required><br>
        <label for="nota3">Nota 3:</label><br>
        <input type="number" id="nota3" name="nota3" step="0.01" required><br><br>

        <label for="faltas">Total de faltas (60 aulas):</label><br>
        <input type="text" id="faltas" name="faltas" required><br><br>

        <button type="submit">Calcular</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        function calculaMedia($notas) {
            return array_sum($notas) / count($notas);
        }

        function verificaAprovacaoNota($media) {
            return $media >= 6 ? "Aprovado" : "Reprovado";
        }

        function calculaFrequencia($faltas, $totalDias) {
            $diasPresenca = $totalDias - count($faltas);
            return ($diasPresenca / $totalDias) * 100;
        }

        function verificaAprovacaoFrequencia($frequencia) {
            return $frequencia >= 70 ? "Aprovado" : "Reprovado";
        }

        $notas = [
            floatval($_POST["nota1"]),
            floatval($_POST["nota2"]),
            floatval($_POST["nota3"]),
        ];

        $faltas = array_map('intval', explode(',', $_POST["faltas"]));
        $totalAulas = 60; 

        $media = calculaMedia($notas);
        $statusNota = verificaAprovacaoNota($media);

        $frequencia = calculaFrequencia($faltas, $totalAulas);
        $statusFrequencia = verificaAprovacaoFrequencia($frequencia);

        echo "<p>Média: $media - Status: $statusNota</p>";
        echo "<p>Frequência: $frequencia% - Status: $statusFrequencia</p>";
    }
    ?>
</body>
</html>
