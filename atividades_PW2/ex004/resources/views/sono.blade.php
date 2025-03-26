<form method="POST" action="{{ route('sono') }}">
    @csrf
    <label>Horas de Sono: <input type="number" name="horas_sono" required></label>
    <button type="submit">Avaliar Sono</button>
</form>

@if(isset($avaliacao))
    <p>Você dormiu {{ $horas }} horas - {{ $avaliacao }}</p>
@endif
