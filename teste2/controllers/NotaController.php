<?php
require_once __DIR__.'/../utils/response.php';
require_once __DIR__.'/../models/Nota.php';
class NotaController {
    public function index(){ response(200,Nota::all()); }
    public function show($id){ $n=Nota::find($id); if(!$n) response(404,['message'=>'Not']); response(200,$n); }
    public function create(){ $d=json_decode(file_get_contents('php://input'),true); $n=Nota::create($d); response(201,$n); }
    public function update($id){ $d=json_decode(file_get_contents('php://input'),true); Nota::update($id,$d); response(200,['message'=>'OK']); }
    public function delete($id){ Nota::delete($id); response(200,['message'=>'OK']); }
}
?>