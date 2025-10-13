import React, { useEffect, useState } from "react";
import { io } from "socket.io-client";
import ProfessorPanel from "./components/ProfessorPanel";
import AlunoPanel from "./components/AlunoPanel";
import LogPanel from "./components/LogPanel";

const socket = io("http://localhost:3000");

export default function App() {
  const [estado, setEstado] = useState("Conectando...");
  const [aulaAtiva, setAulaAtiva] = useState(false);
  const [presentes, setPresentes] = useState([]);
  const [log, setLog] = useState([]);

  const addLog = (msg) => setLog((p) => [`[${new Date().toLocaleTimeString()}] ${msg}`, ...p]);

  useEffect(() => {
    socket.on("connect", () => setEstado("✅ Conectado"));
    socket.on("disconnect", () => setEstado("❌ Desconectado"));


    socket.on("system.sync", (data) => {

      setAulaAtiva(Boolean(data.aulaAtiva));
      setEstado(data.aulaAtiva ? "🟢 Aula Ativa" : "🔴 Aula Inativa");
      setPresentes(data.presentes || []);
    });


    socket.on("aula.iniciada", (msg) => {
      addLog(msg.mensagem || "Aula iniciada");
      setAulaAtiva(true);
    });
    socket.on("aula.encerrada", (msg) => {
      addLog(msg.mensagem || "Aula encerrada");
      setAulaAtiva(false);
    });

    socket.on("aluno.presente", (data) => addLog(data.mensagem || `${data.nome} marcou presença.`));
    socket.on("aluno.atrasado", (data) => addLog(`⚠️ ${data.mensagem}`));
    socket.on("notificacao.emitida", (msg) => addLog(`Aviso: ${msg.mensagem}`));
    socket.on("error.operacao", (err) => addLog(`Erro: ${err.mensagem}`));

    return () => {
      socket.removeAllListeners();
    };
  }, []);

  return (
    <div style={container}>
      <div style={card}>
        <h1 style={{ textAlign: "center", marginBottom: "6px" }}>Monitoramento de Sala de Aula</h1>
        <p style={{ textAlign: "center", fontSize: "1.1em" }}>{estado}</p>

        <div style={painelContainer}>
          <ProfessorPanel socket={socket} aulaAtiva={aulaAtiva} />
          <AlunoPanel socket={socket} />
          <LogPanel log={log} presentes={presentes} />
        </div>
      </div>
    </div>
  );
}


const container = {
  display: "flex",
  justifyContent: "center",
  alignItems: "center",
  height: "100vh",
  background: "linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%)",
  fontFamily: "Arial, sans-serif",
};

const card = {
  background: "#fff",
  padding: "25px",
  borderRadius: "12px",
  boxShadow: "0 8px 20px rgba(0,0,0,0.15)",
  width: "80%",
  maxWidth: "900px",
  minHeight: "85vh",
  overflowY: "auto",
};

const painelContainer = {
  display: "flex",
  flexDirection: "column",
  gap: "15px",
};
