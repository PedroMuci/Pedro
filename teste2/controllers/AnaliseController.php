<?php
require_once __DIR__.'/../utils/response.php';
require_once __DIR__.'/../models/Postagem.php';
require_once __DIR__.'/../models/Analise.php';
class AnaliseController {
    public function index(){ response(200,Postagem::allPending()); }
    public function show($id){ $p=Postagem::find($id); if(!$p) response(404,['message'=>'Not']); response(200,$p); }
    public function create(){ $d=json_decode(file_get_contents('php://input'),true); Analise::feedback($d['postagem_id'],$d['mensagem']); response(201,['message'=>'OK']); }
    public function update($id){ $d=json_decode(file_get_contents('php://input'),true);
        if(isset($d['status'])&&$d['status']==='aprovado'){ Postagem::update($id,['status'=>'aprovado']); response(200,['message'=>'OK']); }
        elseif(isset($d['status'])&&$d['status']==='devolvido'){ Postagem::update($id,['status'=>'devolvido']); Analise::feedback($id,$d['mensagem']??''); response(200,['message'=>'OK']); }
        else response(400,['message'=>'Inv']); }
    public function delete($id){ global $pdo; $pdo->prepare('DELETE FROM feedback_devolucao WHERE id=?')->execute([$id]); response(200,['message'=>'OK']); }
}
?>