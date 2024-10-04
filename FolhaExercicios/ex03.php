<!DOCTYPE html>
<html>
<body>
    <form method="POST">
        Lado do quadrado (m): <input type="number" name="lado"><br>
        <input type="submit" value="Calcular">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $lado = $_POST['lado'];
        $area = $lado * $lado;
        echo "A área do quadrado de lado $lado metros é $area metros quadrados.";
    }
    ?>
</body>
</html>
