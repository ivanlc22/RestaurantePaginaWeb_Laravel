@extends('layouts.header')

@section('contenido')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link rel="stylesheet" href="{{ asset('css/reserva.css') }}">
<head>
    <meta charset="UTF-8">
</head>

@if(auth()->user()->reserva)
    <div class="card">
        <body>
            <br> 
            <h1 style="text-align:center">Tu reserva</h1>   
            <br> 
        </body>
        <table class="content-table" style="margin:0 auto">
            <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Numero de personas</th> 
                <th>Local</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td> <?php echo $reserva->fecha ?> </td>
                    <td> <?php echo $reserva->hora ?> </td>
                    <td> <?php echo $reserva->num_personas ?> </td>
                    <td> <?php echo $local->ciudad ?> </td>
                </tr>
            </tbody>
        </table>
        <form name="modificar" id="modificar" action="{{ route('reserva.mod') }}">
            @csrf
            <button type="submit" class="btn"> Modificar</button>
        </form>
        <form name="eliminar" id="eliminar" action="{{ route('reserva.eliminar') }}" method="POST">
            @csrf
            <button type="submit" class="btn"> Eliminar</button>
        </form>
        <br>
        <br>

    </div>
@else

    <div class="cuadrado2">
        <h4>No tienes ninguna reserva, ¿te gustaría realizar una?</h4>
        <h4><a href="/reservas"> Haz click aqui</a></h4>
    </div>

@endif

@endsection