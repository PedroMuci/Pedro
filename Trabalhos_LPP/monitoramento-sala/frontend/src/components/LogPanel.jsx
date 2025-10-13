import React from "react";
import { motion } from "framer-motion";

export default function LogPanel({ log, presentes }) {
  return (
    <motion.section
      style={painel}
      initial={{ opacity: 0, y: 20 }}
      animate={{ opacity: 1, y: 0 }}
      transition={{ duration: 0.4 }}
    >
      <h2>📜 Log</h2>

      <motion.div style={logBox}>
        {log.length === 0 ? (
          <div>Nenhum evento ainda.</div>
        ) : (
          log.map((msg, i) => (
            <motion.div
              key={i}
              initial={{ opacity: 0, y: 10 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.3, delay: i * 0.05 }}
            >
              {msg}
            </motion.div>
          ))
        )}
      </motion.div>

      <h3>🧍 Presentes</h3>
      <ul>
        {presentes.length === 0 ? (
          <li>Ninguém presente</li>
        ) : (
          presentes.map((p, i) => (
            <motion.li
              key={i}
              initial={{ opacity: 0 }}
              animate={{ opacity: 1 }}
              transition={{ duration: 0.3, delay: i * 0.1 }}
            >
              {p}
            </motion.li>
          ))
        )}
      </ul>
    </motion.section>
  );
}

const painel = {
  background: "#fff",
  padding: "16px",
  borderRadius: "10px",
  boxShadow: "0 2px 6px rgba(0,0,0,0.1)",
};

const logBox = {
  background: "#f7f7f7",
  padding: "10px",
  borderRadius: "6px",
  maxHeight: "200px",
  overflowY: "auto",
};
