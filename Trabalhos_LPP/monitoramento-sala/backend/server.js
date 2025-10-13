const express = require("express");
const http = require("http");
const cors = require("cors");
const { Server } = require("socket.io");

const app = express();
app.use(cors());

const server = http.createServer(app);
const io = new Server(server, { cors: { origin: "*" } });

let aulaAtiva = false;
let presentes = [];
let inicioAula = null; 

function atualizarEstado() {
  io.emit("system.sync", { aulaAtiva, presentes });
}

io.on("connection", (socket) => {
  console.log("Cliente conectado:", socket.id);
  socket.emit("system.sync", { aulaAtiva, presentes });

  socket.on("aula.iniciada", () => {
    aulaAtiva = true;
    presentes = [];
    inicioAula = Date.now();
    io.emit("aula.iniciada", { mensagem: "📚 Aula iniciada pelo professor!" });
    atualizarEstado();
  });

  socket.on("aluno.presente", (data) => {
    if (!aulaAtiva) {
      socket.emit("error.operacao", { mensagem: "A aula ainda não foi iniciada." });
      return;
    }

    const nome = data?.nome?.trim();
    if (!nome) return;
    if (presentes.includes(nome)) return;

    const agora = Date.now();
    const tempoDecorrido = inicioAula ? (agora - inicioAula) / 1000 / 60 : 0;
    const atrasado = tempoDecorrido > 5;

    presentes.push(nome);

    if (atrasado) {
      io.emit("aluno.atrasado", { nome, mensagem: `${nome} chegou atrasado.` });
    } else {
      io.emit("aluno.presente", { nome, mensagem: `${nome} marcou presença.` });
    }

    atualizarEstado();
  });

  socket.on("notificacao.emitida", (data) => {
    const mensagem = data?.mensagem?.trim() || "Nova notificação do professor.";
    io.emit("notificacao.emitida", { mensagem });
  });

  socket.on("aula.encerrada", () => {
    aulaAtiva = false;
    inicioAula = null;
    io.emit("aula.encerrada", { mensagem: "🏁 Aula encerrada!" });
    atualizarEstado();
  });

  socket.on("disconnect", () => console.log("Cliente desconectado:", socket.id));
});

server.listen(3000, () => console.log("Servidor rodando em http://localhost:3000"));
