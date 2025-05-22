<?php
class Nota {
    public static function all() { global $pdo; return $pdo->query('SELECT * FROM avaliacao')->fetchAll(PDO::FETCH_ASSOC); }
    public static function find($id) { global $pdo; $s=$pdo->prepare('SELECT * FROM avaliacao WHERE id=?'); $s->execute([$id]); return $s->fetch(PDO::FETCH_ASSOC); }
    public static function create($d) { global $pdo; $stmt=$pdo->prepare('INSERT INTO avaliacao (postagem_id,conta_id,nota) VALUES(?,?,?) RETURNING id'); $stmt->execute([$d['postagem_id'],$d['conta_id'],$d['nota']]); return ['id'=>$stmt->fetchColumn()]; }
    public static function update($id,$d) { global $pdo; if(isset($d['nota'])){ $pdo->prepare('UPDATE avaliacao SET nota=? WHERE id=?')->execute([$d['nota'],$id]); } }
    public static function delete($id) { global $pdo; $pdo->prepare('DELETE FROM avaliacao WHERE id=?')->execute([$id]); }
}
?>