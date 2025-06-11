@extends('layouts.app')

@section('content')
<div style="text-align:center; margin-top:80px;">
    <h2 style="color:#5D3A2E;">{{ session('mensagem') ?? 'Operação realizada com sucesso!' }}</h2>
</div>
@endsection
    