<!DOCTYPE html>
<html>
<body>
    <?php

    $pastas = array(
        "bsn" => array(
            "3a Fase" => array(
                "desenvWeb",
                "bancoDados 1",
                "engSoft 1"
            ),
            "4a Fase" => array(
                "Intro Web",
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

  
    criarArvore($pastas);
    ?>
</body>
</html>
