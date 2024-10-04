<!DOCTYPE html>
<html>
<body>
    <form method="POST">
        Base (m): <input type="number" name="base"><br>
        Altura (m): <input type="number" name="altura"><br>
        <input type="submit" value="Calcular">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $base = $_POST['base'];
        $altura = $_POST['altura'];
        $area = ($base * $altura) / 2;
        echo "A área do triângulo retângulo com base $base metros e altura $altura metros é $area metros quadrados.";
    }
    ?>
</body>
</html>
