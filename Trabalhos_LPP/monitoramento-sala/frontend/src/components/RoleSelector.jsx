import React from "react";
import { motion } from "framer-motion";

export default function RoleSelector({ onSelect }) {
  return (
    <motion.div
      initial={{ opacity: 0, scale: 0.9 }}
      animate={{ opacity: 1, scale: 1 }}
      transition={{ duration: 0.4 }}
      style={container}
    >
      <h1>🎓 Monitoramento de Sala de Aula</h1>
      <p>Escolha seu papel para acessar o sistema:</p>

      <div style={btnContainer}>
        <motion.button
          whileHover={{ scale: 1.05 }}
          whileTap={{ scale: 0.95 }}
          style={btnProfessor}
          onClick={() => onSelect("professor")}
        >
          👨‍🏫 Sou Professor
        </motion.button>

        <motion.button
          whileHover={{ scale: 1.05 }}
          whileTap={{ scale: 0.95 }}
          style={btnAluno}
          onClick={() => onSelect("aluno")}
        >
          🎓 Sou Aluno
        </motion.button>
      </div>
    </motion.div>
  );
}

// 🎨 Estilos
const container = {
  textAlign: "center",
  background: "#fff",
  padding: "40px",
  borderRadius: "12px",
  boxShadow: "0 8px 20px rgba(0,0,0,0.15)",
  width: "400px",
};

const btnContainer = {
  display: "flex",
  justifyContent: "center",
  gap: "20px",
  marginTop: "20px",
};

const btnProfessor = {
  background: "#007bff",
  color: "white",
  border: "none",
  padding: "12px 20px",
  borderRadius: "8px",
  cursor: "pointer",
  fontSize: "1em",
};

const btnAluno = {
  background: "#28a745",
  color: "white",
  border: "none",
  padding: "12px 20px",
  borderRadius: "8px",
  cursor: "pointer",
  fontSize: "1em",
};
