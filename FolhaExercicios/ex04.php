<!DOCTYPE html>
<html>
<body>
    <form method="POST">
        Lado a (m): <input type="number" name="ladoa"><br>
        Lado b (m): <input type="number" name="ladob"><br>
        <input type="submit" value="Calcular">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $ladoa = $_POST['ladoa'];
        $ladob = $_POST['ladob'];
        $area = $ladoa * $ladob;

        if ($area > 10) {
            echo "<h1>A área do retângulo de lados $ladoa e $ladob metros é $area metros quadrados.</h1>";
        } else {
            echo "<h3>A área do retângulo de lados $ladoa e $ladob metros é $area metros quadrados.</h3>";
        }
    }
    ?>
</body>
</html>
