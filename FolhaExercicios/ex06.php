<!DOCTYPE html>
<html>
<body>
    <form method="POST">
        Maçã (kg): <input type="number" name="maca"><br>
        Melancia (kg): <input type="number" name="melancia"><br>
        Laranja (kg): <input type="number" name="laranja"><br>
        Repolho (kg): <input type="number" name="repolho"><br>
        Cenoura (kg): <input type="number" name="cenoura"><br>
        Batatinha (kg): <input type="number" name="batatinha"><br>
        <input type="submit" value="Calcular">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $precos = ['maca' => 3, 'melancia' => 7, 'laranja' => 4, 'repolho' => 5, 'cenoura' => 2, 'batatinha' => 3];
        $total = 0;

        foreach ($precos as $produto => $preco) {
            $total += $_POST[$produto] * $preco;
        }

        if ($total > 50) {
            echo "<p style='color: red;'>Faltaram R$ " . ($total - 50) . " para completar a compra.</p>";
        } elseif ($total == 50) {
            echo "<p style='color: green;'>Saldo esgotado. Total: R$ 50,00</p>";
        } else {
            echo "<p style='color: blue;'>Ainda pode gastar R$ " . (50 - $total) . "</p>";
        }
    }
    ?>
</body>
</html>
