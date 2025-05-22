<?php
require_once __DIR__.'/../utils/response.php';
require_once __DIR__.'/../models/Conta.php';
class ContaController {
    public function index(){ response(200,Conta::all()); }
    public function show($id){ $c=Conta::find($id); if(!$c) response(404,['message'=>'Not']); response(200,$c); }
    public function create(){ $d=json_decode(file_get_contents('php://input'),true); $n=Conta::create($d); response(201,$n); }
    public function update($id){ $d=json_decode(file_get_contents('php://input'),true); Conta::update($id,$d); response(200,['message'=>'OK']); }
    public function delete($id){ Conta::delete($id); response(200,['message'=>'OK']); }
}
?>