<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link rel="stylesheet" href="{{ asset('css/procesarCompra.css') }}">
<head>
<meta charset="UTF-8">

@extends('layouts.header')
@section('contenido')
<div class="procesar-compra-container">
<h1>Tu carrito</h1>
<br>
@if (Auth::check())
    @foreach ($productosCarrito as $productoCarrito)
        <p>{{ $productoCarrito->nombre }} x{{ $productoCarrito->pivot->cantidad}}...............................................${{ $productoCarrito->precio * $productoCarrito->pivot->cantidad}}</p>
    @endforeach
    <br>
    <h3>total: ${{ $precio }}</h3>
    <br>
    <form method="POST" action="/carrito/realizarCompra">
        @csrf
        <label for="Dirección">Direccion de envio:</label>
        <input type="text" id="direccion" name="direccion" value="{{ $direccion }}" placeholder="{{ $direccion }}">
        <input type="hidden" name="productos" value="{{ $productosCarrito }}">
        <br><br>
        <button type="submit" class="button">Realizar compra</button>
    </form>
@endif
</div>
@endsection
</head>
<body>
</body>
</html>   