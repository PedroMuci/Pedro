<?php
header("Content-Type: text/plain");

echo "Dados recebidos:\n";
print_r($_REQUEST);

echo "\nCabeçalhos da Requisição:\n";
print_r(apache_request_headers());

echo "\nMétodo da Requisição: " . $_SERVER['REQUEST_METHOD'];
?>
