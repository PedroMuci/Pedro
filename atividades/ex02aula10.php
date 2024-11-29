<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício 2 - Aula 10</title>
    <style>
        body {
            background-color: black;
            font-family: monospace;
            color: white;
            text-align: center;
        }
        form {
            margin-top: 50px;
        }
        input, button {
            margin: 5px;
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION["login"] = $_POST["login"];
        $_SESSION["senha"] = $_POST["senha"];
        $_SESSION["dataInicio"] = date("Y-m-d H:i:s");
        $_SESSION["ultimaRequisicao"] = $_SESSION["dataInicio"];

     
        setcookie("usuario", $_SESSION["login"], time() + (60 * 5), "/");
        setcookie("dataInicio", $_SESSION["dataInicio"], time() + (60 * 5), "/");

        echo "<p>Sessão iniciada! Bem-vindo, " . $_SESSION["login"] . "</p>";
        echo "<p>Data de início da sessão: " . $_SESSION["dataInicio"] . "</p>";
    } elseif (isset($_COOKIE["usuario"]) && isset($_COOKIE["dataInicio"])) {
        echo "<p>Usuário: " . $_COOKIE["usuario"] . "</p>";
        echo "<p>Data de início: " . $_COOKIE["dataInicio"] . "</p>";
    } else {
        echo '<form method="POST">
            <label for="login">Login:</label><br>
            <input type="text" id="login" name="login" required><br><br>
            <label for="senha">Senha:</label><br>
            <input type="password" id="senha" name="senha" required><br><br>
            <button type="submit">Entrar</button>
        </form>';
    }
    ?>
</body>
</html>
