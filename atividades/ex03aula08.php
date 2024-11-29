<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prática 3 - Lógica Condicional</title>
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
    <h1>Comparação de Salários</h1>
    <form method="post">
        <label>Salário 1:</label>
        <input type="number" name="salario1" value="3000" required>
        <br><br>
        <label>Salário 2:</label>
        <input type="number" name="salario2" value="4000" required>
        <br><br>
        <button type="submit">Comparar</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $salario1 = $_POST['salario1'];
        $salario2 = $_POST['salario2'];

        if ($salario1 > $salario2) {
            echo "<p>O Valor da variável 1 é maior que o valor da variável 2.</p>";
        } elseif ($salario1 < $salario2) {
            echo "<p>O Valor da variável 1 é menor que o valor da variável 2.</p>";
        } else {
            echo "<p>Os valores são iguais.</p>";
        }
    }
    ?>
</body>
</html>
