<?php
require_once __DIR__.'/../config/database.php';
require_once __DIR__.'/../utils/response.php';
require_once __DIR__.'/../controllers/ContaController.php';
require_once __DIR__.'/../controllers/PostagemController.php';
require_once __DIR__.'/../controllers/NotaController.php';
require_once __DIR__.'/../controllers/AnaliseController.php';

// Routing based on PATH_INFO without .htaccess
$path = $_SERVER['PATH_INFO'] ?? '/';
$parts = explode('/', trim($path, '/'));
$resource = $parts[0] ?? '';
$id = $parts[1] ?? null;
$method = $_SERVER['REQUEST_METHOD'];

switch ($resource) {
    case 'contas':
        $ctrl = new ContaController();
        break;
    case 'postagens':
        $ctrl = new PostagemController();
        break;
    case 'notas':
        $ctrl = new NotaController();
        break;
    case 'analises':
        $ctrl = new AnaliseController();
        break;
    default:
        response(404,['message'=>'Endpoint não encontrado']);
}

if ($method==='GET' && !$id) $ctrl->index();
elseif ($method==='GET' && $id) $ctrl->show($id);
elseif ($method==='POST') $ctrl->create();
elseif ($method==='PUT' && $id) $ctrl->update($id);
elseif ($method==='DELETE' && $id) $ctrl->delete($id);
else response(405,['message'=>'Método não permitido']);
?>