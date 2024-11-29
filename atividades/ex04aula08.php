<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prática 3 - Laço de Repetição</title>
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
    <h1>Laço de Repetição com Condições</h1>
    <form method="post">
        <label>Salário 1:</label>
        <input type="number" name="salario1" value="3000" required>
        <br><br>
        <label>Salário 2:</label>
        <input type="number" name="salario2" value="4000" required>
        <br><br>
        <button type="submit">Executar</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $salario1 = $_POST['salario1'];
        $salario2 = $_POST['salario2'];

        echo "<h2>Execução do Laço:</h2>";
        for ($i = 1; $i <= 100; $i++) {
            $salario1++; 
            echo "<p>Iteração $i: SALARIO1 = $salario1</p>"; 

            if ($i == 50) {
                echo "<p>Parando a execução na iteração $i.</p>";
                break;
            }
        }

        
        if ($salario1 < $salario2) {
            echo "<p>Após o loop, o valor de SALARIO1 ($salario1) é menor que SALARIO2 ($salario2).</p>";
        } else {
            echo "<p>Após o loop, o valor de SALARIO1 ($salario1) não é menor que SALARIO2 ($salario2).</p>";
        }
    }
    ?>
</body>
</html>
