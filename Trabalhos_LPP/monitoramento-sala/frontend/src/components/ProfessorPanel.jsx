import React, { useEffect, useState } from "react";
import { motion } from "framer-motion";

export default function ProfessorPanel({ socket, aulaAtiva }) {
  const [mensagem, setMensagem] = useState("");

  const [localAulaAtiva, setLocalAulaAtiva] = useState(Boolean(aulaAtiva));


  useEffect(() => {
    setLocalAulaAtiva(Boolean(aulaAtiva));
  }, [aulaAtiva]);

  const iniciarAula = () => {
    console.log("Professor: solicitar iniciar aula");
    setLocalAulaAtiva(true); 
    socket.emit("aula.iniciada");
  };

  const encerrarAula = () => {
    console.log("Professor: solicitar encerrar aula");
    setLocalAulaAtiva(false); 
    socket.emit("aula.encerrada");
  };

  const enviarAviso = () => {
    if (!mensagem.trim()) return;
    socket.emit("notificacao.emitida", { mensagem });
    setMensagem("");
  };

  return (
    <motion.section
      style={painel}
      initial={{ opacity: 0, y: 12 }}
      animate={{ opacity: 1, y: 0 }}
      transition={{ duration: 0.35 }}
    >
      <h2>👨‍🏫 Professor</h2>

      <div style={controles}>
  
        {!localAulaAtiva ? (
          <motion.button
            onClick={iniciarAula}
            whileHover={{ scale: 1.03 }}
            whileTap={{ scale: 0.97 }}
          >
            Iniciar Aula
          </motion.button>
        ) : (
          <>
            <input
              placeholder="Mensagem para os alunos"
              value={mensagem}
              onChange={(e) => setMensagem(e.target.value)}
              style={input}
            />
            <motion.button
              whileHover={{ scale: 1.03 }}
              whileTap={{ scale: 0.97 }}
              onClick={enviarAviso}
            >
              Enviar Aviso
            </motion.button>
            <motion.button
              onClick={encerrarAula}
              whileHover={{ scale: 1.03 }}
              whileTap={{ scale: 0.97 }}
              style={{ backgroundColor: "#ff4d4d", color: "#fff" }}
            >
              Encerrar Aula
            </motion.button>
          </>
        )}

      </div>
    </motion.section>
  );
}

const painel = {
  background: "#fff",
  padding: "16px",
  marginBottom: "12px",
  borderRadius: "10px",
  boxShadow: "0 2px 6px rgba(0,0,0,0.1)",
};

const controles = { display: "flex", gap: "8px", flexWrap: "wrap", alignItems: "center" };
const input = { padding: "8px", borderRadius: "6px", border: "1px solid #ccc", minWidth: "200px" };
