

# 🎓 Monitoramento de Sala de Aula — Programação Orientada a Eventos

> Projeto desenvolvido para a disciplina de **Linguagens de Programação e Paradigmas**.
> Tema: **Aplicação Orientada a Eventos com Node.js, Express, Socket.IO e React**

---

## 🧠 Descrição do Projeto

O sistema simula o **ambiente de uma sala de aula conectada**, onde:

* O **professor** pode iniciar e encerrar aulas, além de enviar avisos aos alunos;
* Os **alunos** podem marcar presença;
* O **sistema** registra os eventos em tempo real (início, presenças, atrasos e encerramento);
* Todos os participantes veem atualizações automaticamente — sem precisar recarregar a página.

💡 Caso um aluno entre **5 minutos após o início da aula**, o sistema o marca como **atrasado**.

A aplicação conta com uma **tela inicial de seleção de papel**, onde o usuário escolhe se deseja acessar como **Professor** ou **Aluno**.
Cada papel tem sua própria interface:

* O **Professor** tem acesso aos controles da aula, aos logs e à lista de alunos presentes.
* O **Aluno** pode marcar presença, visualizar os logs e ver os colegas que já estão presentes.

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
    │        ├── RoleSelector.jsx      → Tela inicial para escolher entre Professor e Aluno
    │        ├── ProfessorPanel.jsx    → Controles do professor (iniciar/encerrar aula, avisos)
    │        ├── AlunoPanel.jsx        → Interface do aluno (marcar presença)
    │        └── LogPanel.jsx          → Exibição dos eventos e alunos presentes
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

### 4️⃣ Testar o Sistema em Tempo Real

Ao acessar o link do frontend, será exibida uma **tela inicial com duas opções**:
**👨‍🏫 Sou Professor** e **🎓 Sou Aluno**.

Escolha o papel desejado para acessar a interface correspondente:

#### 👨‍🏫 Professor

* Clique em **Iniciar Aula** para liberar as presenças.
* Envie avisos para todos os alunos conectados.
* Acompanhe o log e a lista de alunos presentes.

#### 🎓 Aluno

* Digite seu nome e clique em **Marcar Presença**.
* Caso entre 5 minutos após o início, aparecerá no log:
  `⚠️ [Nome] chegou atrasado.`
* Visualize o log e os alunos que já marcaram presença.


