<?php

namespace Controllers;

require_once __DIR__ . '/../utils/response.php';
require_once __DIR__ . '/../models/Postagem.php';

class PostagemController {
    public function index() {
        response(200, Postagem::allApproved());
    }

    public function show($id) {
        $post = Postagem::find($id);
        if (!$post) response(404, ['message'=>'Postagem não encontrada']);
        response(200, $post);
    }

    public function create() {
        $data = json_decode(file_get_contents('php://input'), true);
        $new = Postagem::create($data);
        response(201, $new);
    }

    public function update($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        Postagem::update($id, $data);
        response(200, ['message'=>'Atualizado com sucesso']);
    }

    public function delete($id) {
        Postagem::delete($id);
        response(200, ['message'=>'Deletado com sucesso']);
    }
}
?>