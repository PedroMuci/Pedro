<?php

class Conta {
    public static function all() {
        global $pdo;
        $stmt = $pdo->query('SELECT id, nome, email, tipo_conta_id FROM conta');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        global $pdo;
        $stmt = $pdo->prepare('SELECT id, nome, email, tipo_conta_id FROM conta WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO conta (nome, email, senha, tipo_conta_id) VALUES (?, ?, ?, ?) RETURNING id');
        $stmt->execute([$data['nome'], password_hash($data['senha'], PASSWORD_DEFAULT), $data['tipo_conta_id']]);
        return ['id' => $stmt->fetchColumn()];
    }

    public static function update($id, $data) {
        global $pdo;
        $fields = [];
        $values = [];
        foreach (['nome', 'email', 'senha', 'tipo_conta_id'] as $field) {
            if (isset($data[$field])) {
                $values[] = $field === 'senha' ? password_hash($data['senha'], PASSWORD_DEFAULT) : $data[$field];
                $fields[] = "$field = ?";
            }
        }
        if (empty($fields)) return;
        $values[] = $id;
        $sql = 'UPDATE conta SET ' . implode(', ', $fields) . ' WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute($values);
    }

    public static function delete($id) {
        global $pdo;
        $stmt = $pdo->prepare('DELETE FROM conta WHERE id = ?');
        $stmt->execute([$id]);
    }
}
?>