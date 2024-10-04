<!DOCTYPE html>
<html>
<body>
    <form method="POST">
        Valor da moto (R$): <input type="number" name="valor_moto" value="8654"><br>
        <input type="submit" value="Calcular Parcelas">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $valor_moto = $_POST['valor_moto'];

        for ($parcelas = 24, $taxa_juros = 0.015; $parcelas <= 60; $parcelas += 12, $taxa_juros += 0.005) {
            $montante = $valor_moto * (1 + $taxa_juros * $parcelas);
            $parcela = $montante / $parcelas;
            echo "Para $parcelas vezes, a parcela será R$ " . number_format($parcela, 2) . "<br>";
        }
    }
    ?>
</body>
</html>
