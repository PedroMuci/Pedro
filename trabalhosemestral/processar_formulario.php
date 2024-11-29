<?php
$conn = pg_connect("host=localhost dbname=HRAV user=postgres password=senha");

if (!$conn) {
    die("<div style='color: red; font-family: Arial, sans-serif;'>Erro ao conectar com o banco de dados.</div>");
}

$id_dispositivo = $_POST['id_dispositivo'] ?? null;

if (!$id_dispositivo) {
    die("<div style='color: red; font-family: Arial, sans-serif;'>ID do dispositivo não foi informado.</div>");
}

$query_dispositivo = "INSERT INTO dispositivos (id_dispositivo, nome_dispositivo, status) 
                      VALUES ($1, 'Dispositivo Desconhecido', TRUE) 
                      ON CONFLICT (id_dispositivo) DO NOTHING";
pg_query_params($conn, $query_dispositivo, [$id_dispositivo]);

foreach ($_POST as $key => $value) {
    if (strpos($key, 'q') === 0 && is_numeric($value)) {
        $id_pergunta = str_replace('q', '', $key);

        $feedback_key = "feedback_q{$id_pergunta}";
        $feedback_textual = $_POST[$feedback_key] ?? null;

        $query_avaliacao = "INSERT INTO avaliacoes (id_setor, id_pergunta, id_dispositivo, resposta, feedback_textual) 
                            SELECT p.id_setor, $1, $2, $3, $4
                            FROM perguntas p 
                            WHERE p.id_pergunta = $1";
        $result = pg_query_params($conn, $query_avaliacao, [$id_pergunta, $id_dispositivo, $value, $feedback_textual]);

        if (!$result) {
            echo "<div style='color: red; font-family: Arial, sans-serif;'>Erro ao registrar a resposta para a pergunta $id_pergunta.</div>";
        }
    }
}

echo "<div style='text-align: center; font-family: Arial, sans-serif; background-color: #e6f7ff; color: #007bff; padding: 20px; border-radius: 10px;'>
        <h2>O Hospital Regional Alto Vale (HRAV) agradece sua resposta!</h2>
        <p>Sua avaliação é muito importante para nós, pois nos ajuda a melhorar continuamente nossos serviços.</p>
      </div>";

pg_close($conn);
?>

<script>
setTimeout(() => {
    window.close();
}, 5000);
</script>
