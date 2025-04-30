<?php
class PostagemController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function handleRequest($method) {
        switch ($method) {
            case 'GET':
                echo json_encode($this->listar());
                break;
            case 'POST':
                $dados = json_decode(file_get_contents("php://input"), true);
                echo json_encode($this->criar($dados));
                break;
            default:
                http_response_code(405);
                echo json_encode(["mensagem" => "Método não permitido"]);
        }
    }

    public function listar() {
        $stmt = $this->pdo->query("SELECT * FROM postagem");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function criar($dados) {
        $chaves = implode(",", array_keys($dados));
        $valores = ":" . implode(",:", array_keys($dados));
        $sql = "INSERT INTO postagem ($chaves) VALUES ($valores)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($dados);
        return ["mensagem" => "Criado com sucesso"];
    }
}
?>
