<?php?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <title>Escolha uma opção</title>
</head>
<body>
    <h1>Escolha um cálculo</h1>
    <ul>
        <li><a href="{{ route('imc') }}">Calcular IMC</a></li>
        <li><a href="{{ route('sono') }}">Avaliar Sono</a></li>
        <li><a href="{{ route('viagem') }}">Cálculo Gasto Viagem</a></li>
    </ul>
</body>
</html>
