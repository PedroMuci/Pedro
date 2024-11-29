<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = pg_connect("host=localhost dbname=HRAV user=postgres password=senha");
    if (!$conn) {
        die("Erro ao conectar com o banco de dados.");
    }

    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $query = "SELECT * FROM usuarios_admin WHERE login = $1 AND senha = $2";
    $result = pg_query_params($conn, $query, [$login, $senha]);

    if (pg_num_rows($result) > 0) {
        $_SESSION['logged_in'] = true;
        header("Location: central_de_comando.php");
        exit;
    } else {
        $error = "Login ou senha inválidos.";
    }

    pg_close($conn);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #ffffff; 
        }

        form {
            background: #f9f9f9; 
            border: 1px solid #007bff; 
            border-radius: 10px;
            padding: 20px 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1 {
            color: #007bff; 
            margin-bottom: 20px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            background: #007bff;
            color: #fff; 
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            width: 100%;
        }

        button:hover {
            background: #0056b3; 
        }

        p {
            color: #d9534f; 
        }
    </style>
</head>
<body>
    <form action="login.php" method="POST">
        <h1>Login</h1>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
        <input type="text" name="login" placeholder="Login" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
