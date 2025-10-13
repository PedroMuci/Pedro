# 🎓 Monitoramento de Sala de Aula — Programação Orientada a Eventos

> Projeto desenvolvido para a disciplina de **Linguagem de Programação e Paradigmas**.
---

## 🧠 Descrição do Projeto

O sistema simula o **ambiente de uma sala de aula conectada**, onde:

* O **professor** pode iniciar e encerrar aulas, além de enviar avisos aos alunos;
* Os **alunos** podem marcar presença;
* O **sistema** registra os eventos em tempo real (início, presenças, atrasos e encerramento);
* Todos os participantes veem atualizações automaticamente — sem precisar recarregar a página.

💡 Caso um aluno entre **5 minutos após o início da aula**, o sistema o marca como **atrasado**.

---

## 📁 Estrutura do Projeto

O projeto está dividido em duas partes principais:

```
monitoramento-sala/
├── backend/        → Servidor Node.js com Express e Socket.IO
│   └── server.js   → Código responsável pela lógica dos eventos e comunicação em tempo real
│
└── frontend/       → Aplicação React com Vite + Socket.IO Client
    ├── src/
    │   ├── App.jsx                → Lógica principal e integração com o servidor
    │   └── components/            → Componentes da interface
    │        ├── ProfessorPanel.jsx  → Controles do professor (iniciar/encerrar aula, avisos)
    │        ├── AlunoPanel.jsx      → Interface do aluno (marcar presença)
    │        └── LogPanel.jsx        → Exibição dos eventos e alunos presentes
```

---

## ⚙️ Tecnologias Utilizadas

| Categoria             | Ferramenta                                     |
| --------------------- | ---------------------------------------------- |
| 🖥️ Backend           | Node.js + Express + Socket.IO                  |
| 💻 Frontend           | React + Vite + Socket.IO Client                |
| 🎨 Estilo e animações | Framer Motion                                  |
| 💡 Paradigma          | Programação Orientada a Eventos (Event-Driven) |

---

## 🚀 Como Executar o Projeto

### 1️⃣ Clonar o Repositório

```bash
git clone https://github.com/PedroMuci/Pedro/tree/main/Trabalhos_LPP/monitoramento-sala
cd Trabalhos_LPP
cd monitoramento-sala
```

*(substitua `usuario` pelo seu nome de usuário no GitHub caso publique o projeto)*

---

### 2️⃣ Configurar e Executar o **Backend**

```bash
cd backend
npm install
npm run start
```

O servidor iniciará em:

```
http://localhost:3000
```

---

### 3️⃣ Configurar e Executar o **Frontend**

Em outro terminal:

```bash
cd frontend
npm install
npm run dev
```

Após a inicialização, o terminal exibirá um link como:

```
http://localhost:5173
```

Acesse esse link no navegador para abrir o sistema.

---

### 4️⃣ Testar a Comunicação em Tempo Real

1. Abra **duas abas** no navegador (uma como professor, outra como aluno).
2. Na aba do professor:

   * Clique em **Iniciar Aula**.
   * Envie um aviso.
3. Na aba do aluno:

   * Digite o nome e clique em **Marcar Presença**.
4. Observe:

   * Os eventos e logs são atualizados **em tempo real** nas duas abas.
   * Se o aluno entrar 5 minutos depois, aparecerá no log:
     `⚠️ Pedro chegou atrasado.`
