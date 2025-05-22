<?php

class Postagem {
    public static function allApproved() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM postagem WHERE status = 'aprovado'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function allPending() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM postagem WHERE status = 'pendente'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM postagem WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO postagem (titulo, texto, imagem_1, imagem_2, imagem_3, video, musica, fonte, conta_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) RETURNING id');
        $stmt->execute([
            $data['titulo'],
            $data['texto'],
            $data['imagem_1'],
            $data['imagem_2'] ?? null,
            $data['imagem_3'] ?? null,
            $data['video'] ?? null,
            $data['musica'] ?? null,
            $data['fonte'],
            $data['conta_id']
        ]);
        return ['id' => $stmt->fetchColumn()];
    }

    public static function update($id, $data) {
        global $pdo;
        $fields = [];
        $values = [];
        foreach (['titulo', 'texto', 'imagem_1', 'imagem_2', 'imagem_3', 'video', 'musica', 'fonte', 'status'] as $field) {
            if (isset($data[$field])) {
                $fields[] = "$field = ?";
                $values[] = $data[$field];
            }
        }
        if (empty($fields)) return;
        $values[] = $id;
        $sql = 'UPDATE postagem SET ' . implode(', ', $fields) . ' WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute($values);
    }

    public static function delete($id) {
        global $pdo;
        $stmt = $pdo->prepare('DELETE FROM postagem WHERE id = ?');
        $stmt->execute([$id]);
    }
}
?>