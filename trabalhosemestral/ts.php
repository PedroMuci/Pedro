<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação Hospital HRAV</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .pergunta {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .resposta {
            display: flex;
            justify-content: space-between;
        }

        .resposta button {
            width: 40px;
            height: 40px;
            background-color: #ddd;
            border: none;
            border-radius: 50%;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .resposta button:hover {
            transform: scale(1.2);
            background-color: #28a745;
            color: white;
        }

        .resposta button.selected {
            background-color: #218838;
            color: white;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 10px;
        }

        .anonimato {
            font-size: 14px;
            color: #777;
            margin-top: 15px;
        }

        button.submit-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }

        button.submit-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Avaliação dos Serviços</h1>
        <form action="" method="post">
            <div class="pergunta">
                <label for="pergunta1">Como você avalia o atendimento?</label>
                <div class="resposta" id="pergunta1">
                    <?php for ($i = 0; $i <= 10; $i++): ?>
                        <button type="button" onclick="selectAnswer('pergunta1', 'resposta1', <?php echo $i; ?>)">
                            <?php echo $i; ?>
                        </button>
                    <?php endfor; ?>
                </div>
                <input type="hidden" id="resposta1" name="resposta1" value="">
            </div>

            <div class="pergunta">
                <label for="pergunta2">Como você avalia a limpeza das instalações?</label>
                <div class="resposta" id="pergunta2">
                    <?php for ($i = 0; $i <= 10; $i++): ?>
                        <button type="button" onclick="selectAnswer('pergunta2', 'resposta2', <?php echo $i; ?>)">
                            <?php echo $i; ?>
                        </button>
                    <?php endfor; ?>
                </div>
                <input type="hidden" id="resposta2" name="resposta2" value="">
            </div>

            <div class="pergunta">
                <label for="feedback">Comentário (opcional):</label>
                <textarea name="feedback" id="feedback" rows="4" placeholder="Deixe seu comentário"></textarea>
            </div>

            <p class="anonimato">
                Sua avaliação espontânea é anônima, nenhuma informação pessoal é solicitada ou armazenada.
            </p>

            <button type="submit" class="submit-btn">Enviar Avaliação</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $resposta1 = $_POST['resposta1'] ?? null;
            $resposta2 = $_POST['resposta2'] ?? null;
            $feedback = $_POST['feedback'] ?? null;

            echo "<div class='result'>";
            echo "<h2>Obrigado pela sua avaliação!</h2>";
            echo "<p>Avaliação do atendimento: $resposta1</p>";
            echo "<p>Avaliação da limpeza: $resposta2</p>";
            if ($feedback) {
                echo "<p>Comentário: $feedback</p>";
            }
            echo "</div>";
        }
        ?>
    </div>

    <script>
        function selectAnswer(perguntaId, inputId, value) {
            let buttons = document.querySelectorAll(`#${perguntaId} button`);
            buttons.forEach(button => button.classList.remove('selected'));

            event.target.classList.add('selected');

            document.getElementById(inputId).value = value;
        }
    </script>
</body>
</html>
