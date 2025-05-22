<?php
class Analise {
    public static function feedback($pid,$msg) { global $pdo; $pdo->prepare('INSERT INTO feedback_devolucao (postagem_id,mensagem) VALUES(?,?)')->execute([$pid,$msg]); }
}
?>