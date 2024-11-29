SELECT * FROM DISPOSITIVOS

SELECT * FROM AVALIACOES

select * from perguntas

select * from setores

select * from usuarios_admin

-- Criação do banco de dados para o sistema de avaliação do Hospital Regional Alto Vale

CREATE TABLE setores (
    id_setor SERIAL PRIMARY KEY,
    nome_setor VARCHAR(255) NOT NULL,
    status BOOLEAN NOT NULL DEFAULT TRUE
);

INSERT INTO setores (id_setor, nome_setor, status) VALUES
(1, 'Atendimento', TRUE),
(2, 'Enfermaria', TRUE),
(3, 'Organização', TRUE),
(4, 'Diagnóstico', TRUE),
(5, 'Tecnologia', TRUE);

CREATE TABLE dispositivos (
    id_dispositivo SERIAL PRIMARY KEY,
    nome_dispositivo VARCHAR(255) NOT NULL,
    status BOOLEAN NOT NULL DEFAULT TRUE
);

CREATE TABLE perguntas (
    id_pergunta SERIAL PRIMARY KEY,
    texto_pergunta TEXT NOT NULL,
    id_setor INT NOT NULL REFERENCES setores(id_setor),
    status BOOLEAN NOT NULL DEFAULT TRUE
);

INSERT INTO perguntas (id_pergunta, texto_pergunta, id_setor, status) VALUES
(1, 'De 0 a 10, qual é a sua avaliação sobre o atendimento do hospital regional do alto vale?', 1, TRUE),
(2, 'De 0 a 10, como você avalia a empatia dos profissionais durante o atendimento?', 1, TRUE),
(3, 'De 0 a 10, como você avalia a atenção e os cuidados prestados pelos enfermeiros?', 2, TRUE),
(4, 'De 0 a 10, como você avalia o acompanhamento da equipe de enfermagem durante sua estadia?', 2, TRUE),
(5, 'De 0 a 10, qual é a sua avaliação sobre a limpeza do hospital?', 3, TRUE),
(6, 'De 0 a 10, como você avalia a sinalização e a orientação dentro do hospital?', 3, TRUE),
(7, 'De 0 a 10, como você avalia a competência dos profissionais envolvidos no diagnóstico?', 4, TRUE),
(8, 'De 0 a 10, como você avalia o cuidado ao realizar exames (atenção, higiene, conforto)?', 4, TRUE),
(9, 'De 0 a 10, como você avalia a rapidez na realização dos exames solicitados?', 4, TRUE),
(10, 'De 0 a 10, como você avalia a clareza nas explicações sobre os resultados dos exames?', 4, TRUE),
(11, 'De 0 a 10, como você avalia a disponibilidade de exames e procedimentos no hospital?', 4, TRUE),
(12, 'De 0 a 10, como você avalia os recursos tecnológicos utilizados para melhorar o atendimento, como prontuário eletrônico?', 5, TRUE),
(13, 'De 0 a 10, como você avalia o uso da tecnologia para manter você informado(a) sobre o andamento dos seus procedimentos?', 5, TRUE);

CREATE TABLE avaliacoes (
    id_avaliacao SERIAL PRIMARY KEY,
    id_setor INT NOT NULL REFERENCES setores(id_setor),
    id_pergunta INT NOT NULL REFERENCES perguntas(id_pergunta),
    id_dispositivo INT NOT NULL REFERENCES dispositivos(id_dispositivo),
    resposta INT NOT NULL CHECK (resposta BETWEEN 0 AND 10),
    feedback_textual TEXT,
    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
);

CREATE TABLE usuarios_admin (
    id_usuario SERIAL PRIMARY KEY,
    login VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

INSERT INTO usuarios_admin (id_usuario, login, senha) VALUES
(1, 'pedro', '123');
