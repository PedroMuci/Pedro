<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        Valor 1: <input type="number" name="valor1"><br>
        Valor 2: <input type="number" name="valor2"><br>
        Valor 3: <input type="number" name="valor3"><br>
        <input type="submit" value="Calcular">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $valor1 = $_POST['valor1'];
        $valor2 = $_POST['valor2'];
        $valor3 = $_POST['valor3'];
        $soma = $valor1 + $valor2 + $valor3;

        if ($valor1 > 10) {
            echo "<p style='color: blue;'>Soma: $soma</p>";
        } elseif ($valor2 < $valor3) {
            echo "<p style='color: green;'>Soma: $soma</p>";
        } elseif ($valor3 < $valor1 && $valor2) {
            echo "<p style='color: red;'>Soma: $soma</p>";
        }
    }
    ?>
    
</body>
</html>
