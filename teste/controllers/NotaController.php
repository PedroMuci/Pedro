<?php

namespace Controllers;

require_once __DIR__ . '/../utils/response.php';
require_once __DIR__ . '/../models/Nota.php';

class NotaController {
    public function index() {
        response(200, Nota::all());
    }

    public function show($id) {
        $nota = Nota::find($id);
        if (!$nota) response(404, ['message'=>'Nota não encontrada']);
        response(200, $nota);
    }

    public function create() {
        $data = json_decode(file_get_contents('php://input'), true);
        $new = Nota::create($data);
        response(201, $new);
    }

    public function update($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        Nota::update($id, $data);
        response(200, ['message'=>'Atualizado com sucesso']);
    }

    public function delete($id) {
        Nota::delete($id);
        response(200, ['message'=>'Deletado com sucesso']);
    }
}
?>