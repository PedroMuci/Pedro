<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ex09</title>
    <style>
        body {
            background-color: black;
            font-family: monospace;
            color: white;
            text-align: center;
            }
    </style>
</head>
<body>
    <form method="POST">
        Valor da moto (R$): <input type="number" name="valor_moto" value="8654"><br>
        <input type="submit" value="Calcular Parcelas">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $valor_moto = $_POST['valor_moto'];

        for ($parcelas = 24, $taxa_juros = 0.02; $parcelas <= 60; $parcelas += 12, $taxa_juros += 0.003) {
            $montante = $valor_moto * pow(1 + $taxa_juros, $parcelas);
            $parcela = $montante / $parcelas;
            echo "Para $parcelas vezes, a parcela será R$ " . number_format($parcela, 2) . "<br>";
        }
    }
    ?>

</body>
</html>
