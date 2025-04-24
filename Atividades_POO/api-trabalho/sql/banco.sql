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
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
