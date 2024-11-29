<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Avaliação</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e6f7ff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 600px;
            margin-bottom: 20px;
        }

        h1 {
            color: #007bff;
            text-align: center;
        }

        .question {
            display: none;
        }

        .question.active {
            display: block;
        }

        .rating {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .rating button {
            width: 50px;
            height: 50px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            color: #fff;
            cursor: pointer;
            transition: transform 0.2s, border 0.2s;
        }

        .rating button:hover, .rating button.selected {
            transform: scale(1.1);
            border: 2px solid #000;
        }

        .rating .btn-0 { background: #ff0000; }
        .rating .btn-1 { background: #ff4500; }
        .rating .btn-2 { background: #ff6347; }
        .rating .btn-3 { background: #ff8c00; }
        .rating .btn-4 { background: #ffa500; }
        .rating .btn-5 { background: #ffd700; }
        .rating .btn-6 { background: #adff2f; }
        .rating .btn-7 { background: #7fff00; }
        .rating .btn-8 { background: #32cd32; }
        .rating .btn-9 { background: #228b22; }
        .rating .btn-10 { background: #008000; }

        .navigation-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .submit-button, .nav-button {
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
        }

        .submit-button:hover, .nav-button:hover {
            background: #0056b3;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #555;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Avaliação Hospitalar</h1>
        <form id="evaluationForm" action="processar_formulario.php" method="POST">
            <?php
            $conn = pg_connect("host=localhost dbname=HRAV user=postgres password=senha");

            if (!$conn) {
                die("Erro ao conectar com o banco de dados.");
            }

            $query = "SELECT p.id_pergunta, p.texto_pergunta, s.nome_setor 
                      FROM perguntas p 
                      INNER JOIN setores s ON p.id_setor = s.id_setor 
                      WHERE p.status = TRUE AND s.status = TRUE 
                      ORDER BY s.id_setor, p.id_pergunta"; 
            $result = pg_query($conn, $query);

            if ($result) {
                $count = 0;
                while ($row = pg_fetch_assoc($result)) {
                    $class = $count === 0 ? 'question active' : 'question';
                    echo "<div class='$class' id='question-$count'>";
                    echo "<label>" . htmlspecialchars($row['texto_pergunta']) . "</label>";
                    echo "<input type='hidden' name='q{$row['id_pergunta']}' id='q{$row['id_pergunta']}'>";
                    echo "<div class='rating'>";
                    for ($i = 0; $i <= 10; $i++) {
                        echo "<button type='button' class='btn-$i' onclick=\"setRating('q{$row['id_pergunta']}', $i, this)\">$i</button>";
                    }
                    echo "</div>";
                    echo "<textarea name='feedback_q{$row['id_pergunta']}' rows='4' style='width:100%; margin-top: 20px;' placeholder='Deixe um feedback (opcional)'></textarea>";
                    echo "</div>";
                    $count++;
                }
            } else {
                echo "Erro ao buscar perguntas do banco de dados.";
            }

            pg_close($conn);
            ?>
            <input type="hidden" name="id_dispositivo" value="1">
            <div class="navigation-buttons">
                <button type="button" class="nav-button" onclick="prevQuestion()">Voltar</button>
                <button type="button" class="nav-button" onclick="nextQuestion()">Próxima</button>
                <button type="submit" class="submit-button" style="display: none;">Enviar</button>
            </div>
        </form>
    </div>
    <div class="footer">
        <p>Sua avaliação espontânea é anônima, nenhuma informação pessoal é solicitada ou armazenada.</p>
    </div>
    <script>
        let currentQuestion = 0;
        const questions = document.querySelectorAll('.question');
        const nextButton = document.querySelector('.nav-button[onclick="nextQuestion()"]');
        const prevButton = document.querySelector('.nav-button[onclick="prevQuestion()"]');
        const submitButton = document.querySelector('.submit-button');

        function setRating(questionId, rating, button) {
            document.getElementById(questionId).value = rating;
            const buttons = button.parentNode.querySelectorAll('button');
            buttons.forEach(btn => btn.classList.remove('selected'));
            button.classList.add('selected');
        }

        function nextQuestion() {
            if (!isQuestionAnswered(currentQuestion)) {
                alert('Por favor, selecione uma nota antes de prosseguir.');
                return;
            }
            questions[currentQuestion].classList.remove('active');
            currentQuestion++;
            if (currentQuestion < questions.length) {
                questions[currentQuestion].classList.add('active');
            } else {
                nextButton.style.display = 'none';
                submitButton.style.display = 'block';
            }
            prevButton.style.display = 'inline-block';
        }

        function prevQuestion() {
            questions[currentQuestion].classList.remove('active');
            currentQuestion--;
            if (currentQuestion < questions.length) {
                questions[currentQuestion].classList.add('active');
            }
            nextButton.style.display = currentQuestion < questions.length - 1 ? 'inline-block' : 'none';
            submitButton.style.display = currentQuestion === questions.length - 1 ? 'block' : 'none';
            prevButton.style.display = currentQuestion > 0 ? 'inline-block' : 'none';
        }

        function isQuestionAnswered(index) {
            const question = questions[index];
            const input = question.querySelector('input');
            return input.value !== '';
        }

        prevButton.style.display = 'none';
    </script>
</body>
</html>
