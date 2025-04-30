<?php
// api/index.php
require_once 'config/database.php';
require_once 'controllers/PostagemController.php';
require_once 'controllers/ContaController.php';
require_once 'controllers/FeedbackController.php';
require_once 'controllers/AvaliacaoController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

switch (true) {
    case preg_match('/\/postagens/', $uri):
        $controller = new PostagemController($pdo);
        $controller->handleRequest($method);
        break;

    case preg_match('/\/contas/', $uri):
        $controller = new ContaController($pdo);
        $controller->handleRequest($method);
        break;

    case preg_match('/\/feedbacks/', $uri):
        $controller = new FeedbackController($pdo);
        $controller->handleRequest($method);
        break;

    case preg_match('/\/avaliacoes/', $uri):
        $controller = new AvaliacaoController($pdo);
        $controller->handleRequest($method);
        break;

    default:
        http_response_code(404);
        echo json_encode(["mensagem" => "Rota não encontrada"]);
        break;
}
?>
