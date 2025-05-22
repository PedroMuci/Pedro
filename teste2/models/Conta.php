<?php
class Conta {
    public static function all() { global $pdo; return $pdo->query('SELECT * FROM conta')->fetchAll(PDO::FETCH_ASSOC); }
    public static function find($id) { global $pdo; $s=$pdo->prepare('SELECT * FROM conta WHERE id=?'); $s->execute([$id]); return $s->fetch(PDO::FETCH_ASSOC); }
    public static function create($d) { global $pdo; $stmt=$pdo->prepare('INSERT INTO conta (nome,email,senha,tipo_conta_id) VALUES(?,?,?,?) RETURNING id'); $stmt->execute([$d['nome'],$d['email'],password_hash($d['senha'],PASSWORD_DEFAULT),$d['tipo_conta_id']]); return ['id'=>$stmt->fetchColumn()]; }
    public static function update($id,$d) { global $pdo; $f=[]; $v=[]; foreach(['nome','email','senha','tipo_conta_id'] as $k){ if(isset($d[$k])){ $v[]= $k==='senha'?password_hash($d['senha'],PASSWORD_DEFAULT):$d[$k]; $f[]="$k=?"; }} if(empty($f)) return; $v[]=$id; $pdo->prepare('UPDATE conta SET '.implode(',',$f).' WHERE id=?')->execute($v); }
    public static function delete($id) { global $pdo; $pdo->prepare('DELETE FROM conta WHERE id=?')->execute([$id]); }
}
?>