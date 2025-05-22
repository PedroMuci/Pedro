<?php
class Postagem {
    public static function allApproved() { global $pdo; return $pdo->query("SELECT * FROM postagem WHERE status='aprovado'")->fetchAll(PDO::FETCH_ASSOC); }
    public static function allPending() { global $pdo; return $pdo->query("SELECT * FROM postagem WHERE status='pendente'")->fetchAll(PDO::FETCH_ASSOC); }
    public static function find($id) { global $pdo; $s=$pdo->prepare('SELECT * FROM postagem WHERE id=?'); $s->execute([$id]); return $s->fetch(PDO::FETCH_ASSOC); }
    public static function create($d) { global $pdo; $stmt=$pdo->prepare('INSERT INTO postagem (titulo,texto,imagem_1,imagem_2,imagem_3,video,musica,fonte,conta_id) VALUES(?,?,?,?,?,?,?,?,?) RETURNING id'); $stmt->execute([$d['titulo'],$d['texto'],$d['imagem_1'],$d['imagem_2']??null,$d['imagem_3']??null,$d['video']??null,$d['musica']??null,$d['fonte'],$d['conta_id']]); return ['id'=>$stmt->fetchColumn()]; }
    public static function update($id,$d) { global $pdo; $f=[];$v=[]; foreach(['titulo','texto','imagem_1','imagem_2','imagem_3','video','musica','fonte','status'] as $k){ if(isset($d[$k])){ $v[]=$d[$k]; $f[]="$k=?"; }} if(empty($f)) return; $v[]=$id; $pdo->prepare('UPDATE postagem SET '.implode(',',$f).' WHERE id=?')->execute($v); }
    public static function delete($id) { global $pdo; $pdo->prepare('DELETE FROM postagem WHERE id=?')->execute([$id]); }
}
?>