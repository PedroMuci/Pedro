<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'teste002');
define('DB_USER', 'postgres');
define('DB_PASS', 'ipdw8331');

try {
    $pdo = new PDO("pgsql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error'=>'Erro ao conectar: '.$e->getMessage()]);
    exit;
}
?>