<form method="POST" action="{{ route('viagem') }}">
    @csrf
    <label>Distância (km): <input type="number" name="distancia" required></label>
    <label>Consumo (km/l): <input type="number" name="consumo" required></label>
    <label>Preço do Combustível (R$/l): <input type="number" step="0.01" name="preco_combustivel" required></label>
    <button type="submit">Calcular Gasto</button>
</form>

@if(isset($custo))
    <p>Custo estimado da viagem: R$ {{ number_format($custo, 2, ',', '.') }}</p>
@endif
