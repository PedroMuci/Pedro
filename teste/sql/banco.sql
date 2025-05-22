-- Criação do banco de dados
CREATE DATABASE historias_perdidas;

\c historias_perdidas;

-- TABELA: tipo_conta
CREATE TABLE tipo_conta (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(50) NOT NULL UNIQUE
);
INSERT INTO tipo_conta (nome) VALUES ('leitor'), ('criador'), ('administrador');

-- TABELA: conta
CREATE TABLE conta (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo_conta_id INTEGER NOT NULL REFERENCES tipo_conta(id)
);

-- TABELA: postagem
CREATE TABLE postagem (
    id SERIAL PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    texto TEXT NOT NULL,
    imagem_1 TEXT NOT NULL,
    imagem_2 TEXT,
    imagem_3 TEXT,
    video TEXT,
    musica TEXT,
    fonte TEXT NOT NULL,
    status VARCHAR(30) NOT NULL DEFAULT 'pendente',
    nota NUMERIC(3,1) DEFAULT 0,
    conta_id INTEGER NOT NULL REFERENCES conta(id),
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- TABELA: palavra_chave
CREATE TABLE palavra_chave (
    id SERIAL PRIMARY KEY,
    texto VARCHAR(100) UNIQUE NOT NULL
);

-- TABELA: postagem_palavra_chave
CREATE TABLE postagem_palavra_chave (
    postagem_id INTEGER REFERENCES postagem(id) ON DELETE CASCADE,
    palavra_chave_id INTEGER REFERENCES palavra_chave(id) ON DELETE CASCADE,
    PRIMARY KEY (postagem_id, palavra_chave_id)
);

-- TABELA: feedback_devolucao
CREATE TABLE feedback_devolucao (
    id SERIAL PRIMARY KEY,
    postagem_id INTEGER NOT NULL REFERENCES postagem(id),
    mensagem TEXT NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- TABELA: avaliacao
CREATE TABLE avaliacao (
    id SERIAL PRIMARY KEY,
    postagem_id INTEGER NOT NULL REFERENCES postagem(id),
    conta_id INTEGER NOT NULL REFERENCES conta(id),
    nota INTEGER CHECK (nota BETWEEN 0 AND 10),
    UNIQUE (postagem_id, conta_id)
);

-- Trigger para atualizado_em
CREATE OR REPLACE FUNCTION atualiza_data()
RETURNS TRIGGER AS $$
BEGIN
   NEW.atualizado_em = CURRENT_TIMESTAMP;
   RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER atualiza_postagem
BEFORE UPDATE ON postagem
FOR EACH ROW
EXECUTE FUNCTION atualiza_data();