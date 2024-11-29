<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Central de Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 90%;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .dashboard-button {
            display: block;
            margin: 10px auto;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            padding: 15px 20px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            transition: 0.3s;
            width: 80%;
        }

        .dashboard-button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Central de Controle</h1>
        <a href="dashboard_perguntas.php" class="dashboard-button">Dashboard de Perguntas</a>
        <a href="dashboard_setores.php" class="dashboard-button">Dashboard de Setores</a>
        <a href="feedback.php" class="dashboard-button">Feedbacks</a>
        <a href="cadastroperguntas.php" class="dashboard-button">Cadastrar Nova Pergunta</a>
        <a href="cadastrardispositivo.php" class="dashboard-button">Cadastrar Dispositivo</a>
        <a href="gerenciardados.php" class="dashboard-button">Gerenciador de Dados</a>
    </div>
</body>
</html>
