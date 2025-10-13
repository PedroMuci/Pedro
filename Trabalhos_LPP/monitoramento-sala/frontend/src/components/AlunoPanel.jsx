import React, { useState, useEffect } from "react";
import { motion, AnimatePresence } from "framer-motion";

export default function AlunoPanel({ socket }) {
  const [nome, setNome] = useState("");
  const [mensagem, setMensagem] = useState("");
  const [corMensagem, setCorMensagem] = useState("green");

  useEffect(() => {
    socket.on("aluno.presente", (data) => {
      if (data && data.nome) {
        setMensagem(`Presença registrada para ${data.nome}!`);
        setCorMensagem("green");
        setTimeout(() => setMensagem(""), 3000);
      }
    });

    socket.on("error.operacao", (err) => {
      if (err?.mensagem) {
        setMensagem(err.mensagem);
        setCorMensagem("red");
        setTimeout(() => setMensagem(""), 3000);
      }
    });

    return () => {
      socket.off("aluno.presente");
      socket.off("error.operacao");
    };
  }, [socket]);

  const marcarPresenca = () => {
    if (!nome.trim()) {
      alert("Digite seu nome antes de marcar presença.");
      return;
    }
    socket.emit("aluno.presente", { nome: nome.trim() });
    setNome("");
  };

  return (
    <motion.section
      style={painel}
      initial={{ opacity: 0, y: 20 }}
      animate={{ opacity: 1, y: 0 }}
      transition={{ duration: 0.4 }}
    >
      <h2>🎓 Aluno</h2>
      <div style={controles}>
        <input
          placeholder="Seu nome"
          value={nome}
          onChange={(e) => setNome(e.target.value)}
          style={input}
        />
        <motion.button
          whileHover={{ scale: 1.05 }}
          whileTap={{ scale: 0.95 }}
          onClick={marcarPresenca}
        >
          Marcar Presença
        </motion.button>
      </div>

      <AnimatePresence>
        {mensagem && (
          <motion.div
            key="mensagem"
            initial={{ opacity: 0, y: -10 }}
            animate={{ opacity: 1, y: 0 }}
            exit={{ opacity: 0, y: -10 }}
            transition={{ duration: 0.4 }}
            style={{
              marginTop: 10,
              color: corMensagem,
              fontWeight: "bold",
            }}
          >
            {corMensagem === "green" ? "✅ " : "❌ "}
            {mensagem}
          </motion.div>
        )}
      </AnimatePresence>
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

const controles = {
  display: "flex",
  gap: "8px",
  flexWrap: "wrap",
  alignItems: "center",
};

const input = {
  padding: "8px",
  borderRadius: "6px",
  border: "1px solid #ccc",
  minWidth: "200px",
};
