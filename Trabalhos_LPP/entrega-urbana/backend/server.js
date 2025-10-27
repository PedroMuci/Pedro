const express = require("express");
const cors = require("cors");
const app = express();
app.use(cors());
app.use(express.json());

const validarEntrega = (entrega) => {
  const { peso, volume, zona, pedagio, janela } = entrega;
  const erros = [];

  const p = Number(peso);
  const v = Number(volume);
  const ped = Number(pedagio);

  if (isNaN(p) || isNaN(v) || isNaN(ped)) erros.push("Valores numéricos inválidos.");
  if (p <= 0 || v <= 0) erros.push("Peso e volume devem ser positivos.");
  if (!["A", "B", "C"].includes(zona)) erros.push("Zona inválida (A, B ou C).");
  if (ped < 0) erros.push("Pedágio não pode ser negativo.");
  if (!["normal", "critica"].includes(janela)) erros.push("Janela inválida.");

  return erros;
};

const calcularCusto = (entrega) => {
  const precosBase = { A: 10, B: 15, C: 20 };

  const peso = Number(entrega.peso);
  const volume = Number(entrega.volume);
  const zona = entrega.zona;
  const pedagio = Number(entrega.pedagio);
  const janela = entrega.janela;

  const custoZona = precosBase[zona];
  const custoPeso = peso * 0.5;
  const custoVolume = volume * 0.3;
  const custoPedagio = pedagio;
  const custoJanela = janela === "critica" ? 5 : 0;

  const total = custoZona + custoPeso + custoVolume + custoPedagio + custoJanela;

  return {
    custoZona,
    custoPeso,
    custoVolume,
    custoPedagio,
    custoJanela,
    total,
  };
};

app.post("/calcular", (req, res) => {
  const entregas = req.body.entregas;

  const resultados = entregas.map((entrega) => {
    const erros = validarEntrega(entrega);
    if (erros.length > 0) {
      return { entrega, erros };
    }
    const custos = calcularCusto(entrega);
    return { entrega, custos };
  });

  res.json(resultados);
});

const PORT = 3001;
app.listen(PORT, () => console.log(`Servidor rodando na porta ${PORT}`));
