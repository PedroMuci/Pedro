<?php

class Analise {
    public static function feedback($postagem_id, $mensagem) {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO feedback_devolucao (postagem_id, mensagem) VALUES (?, ?)');
        $stmt->execute([$postagem_id, $mensagem]);
    }
}
?>