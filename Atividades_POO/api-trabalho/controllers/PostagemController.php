<?php
require_once '../models/Postagem.php';
require_once '../utils/response.php';

class PostagemController {
    public function index() {
        $postagens = Postagem::all();
        jsonResponse($postagens);
    }

    public function show($id) {
        $postagem = Postagem::find($id);
        $postagem ? jsonResponse($postagem) : jsonResponse(["error" => "Postagem não encontrada"], 404);
    }

    public function store() {
        $data = json_decode(file_get_contents('php://input'), true);
        $nova = Postagem::create($data);
        jsonResponse($nova, 201);
    }

    public function update($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        $resultado = Postagem::update($id, $data);
        jsonResponse($resultado);
    }

    public function destroy($id) {
        $apagado = Postagem::delete($id);
        jsonResponse(["deleted" => $apagado]);
    }
}
