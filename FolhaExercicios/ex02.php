<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ex02</title>
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
