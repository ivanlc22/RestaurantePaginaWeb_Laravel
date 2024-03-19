<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link rel="stylesheet" href="{{ asset('css/pedidoRealizado.css') }}">
<head>
<meta charset="UTF-8">

@extends('layouts.header')
@section('contenido')
<br>
@if (Auth::check())
<div class="compra-realizada">
    <br>
    <h1>¡Muchas gracias por confiar en nosotros!</h1>
    <br>
    <p>Su pedido llegará en breve a la dirección: {{ $direccion }}</p>
    <br><br>
    <a href="/carrito" class="fa fa-reply icon" aria-hidden="true"></a>
    <a href="/perfil/historial-pedidos" class="fa fa-list-alt icon" aria-hidden="true"></a>
</div>
@endif
@endsection
</head>
<body>
</body>
</html>   