<?php
require_once __DIR__.'/../utils/response.php';
require_once __DIR__.'/../models/Postagem.php';
class PostagemController {
    public function index(){ response(200,Postagem::allApproved()); }
    public function show($id){ $p=Postagem::find($id); if(!$p) response(404,['message'=>'Not']); response(200,$p); }
    public function create(){ $d=json_decode(file_get_contents('php://input'),true); $n=Postagem::create($d); response(201,$n); }
    public function update($id){ $d=json_decode(file_get_contents('php://input'),true); Postagem::update($id,$d); response(200,['message'=>'OK']); }
    public function delete($id){ Postagem::delete($id); response(200,['message'=>'OK']); }
}
?>