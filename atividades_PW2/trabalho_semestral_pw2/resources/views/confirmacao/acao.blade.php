@extends('layouts.app')

@section('content')
<div style="text-align:center; margin-top:80px;">
    <h2>Deseja realmente executar esta ação?</h2>
    <div style="margin-top:30px;">
        <button onclick="history.back()" class="btn-acao" style="margin-right:15px;">Cancelar</button>
        <form method="POST" action="{{ url()->current() }}">
            @csrf
            <button class="btn-acao">Confirmar</button>
        </form>
    </div>
</div>
@endsection
