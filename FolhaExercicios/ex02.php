<!DOCTYPE html>
<html>
<body>
    <form method="POST">
        Número: <input type="number" name="numero"><br>
        <input type="submit" value="Testar">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $numero = $_POST['numero'];
        if ($numero % 2 == 0) {
            echo "Valor divisível por 2";
        } else {
            echo "O valor não é divisível por 2";
        }
    }
    ?>
</body>
</html>
