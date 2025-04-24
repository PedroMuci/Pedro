<?php
$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

require_once '../utils/response.php';
require_once '../controllers/PostagemController.php';

if (preg_match('/\/postagens(\/([0-9]+))?/', $request, $matches)) {
    $controller = new PostagemController();
    $id = $matches[2] ?? null;

    switch ($method) {
        case 'GET':
            $id ? $controller->show($id) : $controller->index();
            break;
        case 'POST':
            $controller->store();
            break;
        case 'PUT':
            $controller->update($id);
            break;
        case 'DELETE':
            $controller->destroy($id);
            break;
        default:
            jsonResponse(["error" => "Método não suportado"], 405);
    }
} else {
    jsonResponse(["error" => "Rota não encontrada"], 404);
}
