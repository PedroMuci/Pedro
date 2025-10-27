import React, { useState } from "react";
import axios from "axios";
import "./App.css";

function App() {
  const [entrega, setEntrega] = useState({
    peso: "",
    volume: "",
    zona: "A",
    pedagio: "",
    janela: "normal",
  });

  const [resultado, setResultado] = useState(null);
  const [loading, setLoading] = useState(false);

  const handleChange = (e) => {
    setEntrega({ ...entrega, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);
    try {
      const res = await axios.post("http://localhost:3001/calcular", {
        entregas: [entrega],
      });
      setResultado(res.data[0]);
    } catch (err) {
      console.error("Erro ao calcular:", err);
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="container">
      <h1 className="titulo">Simulador de Entrega Urbana</h1>
      <form className="formulario" onSubmit={handleSubmit}>
        <div className="campo">
          <label>Peso (kg):</label>
          <input
            type="number"
            name="peso"
            value={entrega.peso}
            onChange={handleChange}
            required
          />
        </div>

        <div className="campo">
          <label>Volume (m³):</label>
          <input
            type="number"
            name="volume"
            value={entrega.volume}
            onChange={handleChange}
            required
          />
        </div>

        <div className="campo">
          <label>Zona:</label>
          <select
            name="zona"
            value={entrega.zona}
            onChange={handleChange}
            required
          >
            <option value="A">Zona A</option>
            <option value="B">Zona B</option>
            <option value="C">Zona C</option>
          </select>
        </div>

        <div className="campo">
          <label>Pedágio (R$):</label>
          <input
            type="number"
            name="pedagio"
            value={entrega.pedagio}
            onChange={handleChange}
            required
          />
        </div>

        <div className="campo">
          <label>Janela de Entrega:</label>
          <select
            name="janela"
            value={entrega.janela}
            onChange={handleChange}
            required
          >
            <option value="normal">Normal</option>
            <option value="critica">Crítica</option>
          </select>
        </div>

        <button className="botao" type="submit" disabled={loading}>
          {loading ? "Calculando..." : "Calcular"}
        </button>
      </form>

      {resultado && (
        <div className="resultado">
          {resultado.erros ? (
            <div className="erro">
              <h3>Erros encontrados:</h3>
              <ul>
                {resultado.erros.map((erro, index) => (
                  <li key={index}>{erro}</li>
                ))}
              </ul>
            </div>
          ) : (
            <div className="caixa-resultado">
              <h3>Resultado do Cálculo</h3>
              <p><strong>Custo Zona:</strong> R$ {resultado.custos.custoZona.toFixed(2)}</p>
              <p><strong>Custo Peso:</strong> R$ {resultado.custos.custoPeso.toFixed(2)}</p>
              <p><strong>Custo Volume:</strong> R$ {resultado.custos.custoVolume.toFixed(2)}</p>
              <p><strong>Custo Pedágio:</strong> R$ {resultado.custos.custoPedagio.toFixed(2)}</p>
              <p><strong>Custo Janela:</strong> R$ {resultado.custos.custoJanela.toFixed(2)}</p>
              <h2>Total: R$ {resultado.custos.total.toFixed(2)}</h2>
            </div>
          )}
        </div>
      )}
    </div>
  );
}

export default App;
