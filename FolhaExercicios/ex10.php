<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ex10</title>
    <style>
        body {
            background-color: black;
            font-family: monospace;
            color: white;
            }
    </style>
</head>
<body>
    <?php

    $materias = array(
        "bsn" => array(
            "3a Fase" => array(
                //Na verdade desenvolvimento web é na segunda fase, mas como foi solicitado, deixamos na terceira fase mesmo
                "desenvWeb",
                "bancoDados 1",
                "engSoft 1"
            ),
            "4a Fase" => array(
                //No array de exemplo tá intro web, mas como a materia é programação web, eu deixei prog web
                "Prog Web",
                "bancoDados 2",
                "engSoft 2"
            )
        )
    );


    function criarArvore($array) {
        echo "<ul>";
        foreach ($array as $key => $value) {
            echo "<li>";
            if (is_array($value)) {
                echo "$key";
                criarArvore($value); 
            } else {
                echo "$value";
            }
            echo "</li>";
        }
        echo "</ul>";
    }

  
    criarArvore($materias);
    ?>
</body>
</html>
