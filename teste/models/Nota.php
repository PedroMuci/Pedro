<?php

class Nota {
    public static function all() {
        global $pdo;
        $stmt = $pdo->query('SELECT * FROM avaliacao');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM avaliacao WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO avaliacao (postagem_id, conta_id, nota) VALUES (?, ?, ?) RETURNING id');
        $stmt->execute([$data['postagem_id'], $data['conta_id'], $data['nota']]);
        return ['id' => $stmt->fetchColumn()];
    }

    public static function update($id, $data) {
        global $pdo;
        if (isset($data['nota'])) {
            $stmt = $pdo->prepare('UPDATE avaliacao SET nota = ? WHERE id = ?');
            $stmt->execute([$data['nota'], $id]);
        }
    }

    public static function delete($id) {
        global $pdo;
        $stmt = $pdo->prepare('DELETE FROM avaliacao WHERE id = ?');
        $stmt->execute([$id]);
    }
}
?>