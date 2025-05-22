<?php

namespace Controllers;

require_once __DIR__ . '/../utils/response.php';
require_once __DIR__ . '/../models/Conta.php';

class ContaController {
    public function index() {
        response(200, Conta::all());
    }

    public function show($id) {
        $conta = Conta::find($id);
        if (!$conta) response(404, ['message'=>'Conta não encontrada']);
        response(200, $conta);
    }

    public function create() {
        $data = json_decode(file_get_contents('php://input'), true);
        $new = Conta::create($data);
        response(201, $new);
    }

    public function update($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        Conta::update($id, $data);
        response(200, ['message'=>'Atualizado com sucesso']);
    }

    public function delete($id) {
        Conta::delete($id);
        response(200, ['message'=>'Deletado com sucesso']);
    }
}
?>