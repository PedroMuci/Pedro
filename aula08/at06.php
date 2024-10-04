<!DOCTYPE html>
<html>
<head>
    <title>Aula 08 - pratica 06</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }
        table, th, td {
            border: 1px solid black;
            text-align: center;
        }
        th, td {
            padding: 10px;
        }
        th {
            background-color: #3E95CD;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<?php

$disciplinas = [
    ["Matemática", 5, 8.5],
    ["Português", 2, 9],
    ["Geografia", 10, 6],
    ["Educação Física", 2, 8]
];


echo "<table>";
echo "<tr><th>Disciplina</th><th>Faltas</th><th>Média</th></tr>";

foreach ($disciplinas as $disciplina) {
    echo "<tr>";
    echo "<td>" . $disciplina[0] . "</td>";
    echo "<td>" . $disciplina[1] . "</td>";
    echo "<td>" . $disciplina[2] . "</td>";
    echo "</tr>";
}

echo "</table>";
?>

</body>
</html>
