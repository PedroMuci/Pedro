<?php
require_once '../config/database.php';

class Postagem {
    public static function all() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM postagem");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM postagem WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO postagem (titulo, texto, imagem_1, fonte) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $data['titulo'],
            $data['texto'],
            $data['imagem_1'],
            $data['fonte'],
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($id, $data) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE postagem SET titulo = ?, texto = ?, imagem_1 = ?, fonte = ? WHERE id = ? RETURNING *");
        $stmt->execute([
            $data['titulo'],
            $data['texto'],
            $data['imagem_1'],
            $data['fonte'],
            $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function delete($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM postagem WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
