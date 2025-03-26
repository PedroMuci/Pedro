
<form method="POST" action="{{ route('imc') }}">
    @csrf
    <label>Peso (kg): <input type="number" name="peso" step="0.1" required></label>
    <label>Altura (m): <input type="number" name="altura" step="0.01" required></label>
    <button type="submit">Calcular IMC</button>
</form>

@if(isset($imc))
    <p>Seu IMC é {{ number_format($imc, 2) }} - {{ $classificacao }}</p>
@endif
