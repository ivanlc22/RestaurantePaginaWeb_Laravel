@extends('layouts.header')
@section('contenido')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link rel="stylesheet" href="{{ asset('css/header.css') }}">
<link rel="stylesheet" href="{{ asset('css/historial-pedidos.css') }}">
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
{{$cont = 1}}
<head>
    <meta charset="UTF-8">
    <title>Historial de Pedidos</title>
</head>
<body>
    <br>
    <h1>Historial de Pedidos</h1>
    <br>

    <div class="grid-container">
    @foreach($pedidos as $pedido)
    <div class="grid-item">
        <p><strong>Pedido {{$cont++}}</strong></p>
        <br>
        @foreach($pedido->producto as $producto)
        {{$producto->nombre}}: {{$producto->pivot->cantidad}} uds.<br/>
        @endforeach
    </div>
    @endforeach
    </div>

</body>

@endsection