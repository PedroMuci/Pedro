<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ex07</title>
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
        Valor do carro (R$): <input type="number" name="valor_carro" value="22500"><br>
        Valor da parcela (R$): <input type="number" name="parcela" value="489.65"><br>
        Quantidade de parcelas: <input type="number" name="parcelas" value="60"><br>
        <input type="submit" value="Calcular Juros">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $valor_carro = $_POST['valor_carro'];
        $parcela = $_POST['parcela'];
        $parcelas = $_POST['parcelas'];
        $total_pago = $parcela * $parcelas;
        $juros = $total_pago - $valor_carro;

        echo "O valor dos juros pagos por Mariazinha será de R$ $juros.";
    }
    ?>
</body>
</html>
