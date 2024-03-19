@extends('layouts.header')
@section('contenido')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <div class="cuadrado">
    <div class="centrar">
        <h1>Perfil de {{Auth::user()->name}}</h1>
        <p>Nombre: {{Auth::user()->name}}</p>
        <p>Correo electrónico: {{Auth::user()->email}}</p>
        <p>Teléfono: {{Auth::user()->cliente->telefono}}</p>
        <p>Dirección: {{Auth::user()->cliente->direccion}}</p>
        <p><div class="modificar"><a href="/modificar-perfil">Modificar perfil</a></div> <a id="logo-historial" href="/perfil/historial-pedidos"><div class="letras-logo">Historial de pedidos</div><i class="fa fa-list-alt"></i></a></p>
        
       
    </div>
    </div>
    </section>
</body>
@endsection