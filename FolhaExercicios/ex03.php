<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ex03</title>
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
