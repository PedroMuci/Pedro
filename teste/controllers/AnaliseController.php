<?php

namespace Controllers;

require_once __DIR__ . '/../utils/response.php';
require_once __DIR__ . '/../models/Postagem.php';
require_once __DIR__ . '/../models/Analise.php';

class AnaliseController {
    public function index() {
        response(200, Postagem::allPending());
    }

    public function show($id) {
        $post = Postagem::find($id);
        if (!$post) response(404, ['message'=>'Postagem não encontrada']);
        response(200, $post);
    }

    public function create() {
        $data = json_decode(file_get_contents('php://input'), true);
        Analise::feedback($data['postagem_id'], $data['mensagem']);
        response(201, ['message'=>'Feedback enviado']);
    }

    public function update($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['status']) && $data['status'] === 'aprovado') {
            Postagem::update($id, ['status'=>'aprovado']);
            response(200, ['message'=>'Postagem aprovada']);
        } elseif (isset($data['status']) && $data['status'] === 'devolvido') {
            Postagem::update($id, ['status'=>'devolvido']);
            Analise::feedback($id, $data['mensagem'] ?? '');
            response(200, ['message'=>'Postagem devolvida']);
        } else {
            response(400, ['message'=>'Status inválido']);
        }
    }

    public function delete($id) {
        global $pdo;
        $stmt = $pdo->prepare('DELETE FROM feedback_devolucao WHERE id = ?');
        $stmt->execute([$id]);
        response(200, ['message'=>'Feedback deletado']);
    }
}
?>