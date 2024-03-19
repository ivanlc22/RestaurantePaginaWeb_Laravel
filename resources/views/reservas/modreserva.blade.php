@extends('layouts.header')

@section('contenido')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link rel="stylesheet" href="{{ asset('css/reserva.css') }}">
<head>
    <meta charset="UTF-8">
</head>

@if ( session('mensaje') )
    <h3><div class="alert">{{ session('mensaje') }}</div></h3>
@endif

@if(count($errors) > 0)
	<div class="errores">
		<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
		</ul>
	</div>
@endif

<main>
    <h1>Modificar reserva</h1>
    <div class="cuadrado">
        <form action="{{ route('reserva.modificar') }}" method="POST">
            @csrf
            <p> Fecha: <input
                type="date"
                name="fecha"
                value="{{ $reserva->fecha }}"
                class="form-control mb-2"
            /></p>
            <p> Hora: <input
                type="time"
                name="hora"
                class="form-control mb-2"
                value="{{ $reserva->hora }}"
                min= "12:00" 
                max= "23:00"
            /></p>
            <p>Número de personas: <input
                type="number"
                name="num_personas"
                class="form-control mb-2"
                value="{{ $reserva->num_personas }}"
            /></p>
            <p>Local: <select name="id_local" id="id_local" >
                <option value="{{ $local_actual['id_local'] }}" selected>{{ $local_actual->ciudad }}</option>
                @foreach($locales as $local)
                    @if($local['id_local'] != $reserva->id_local)
                        <option value="{{ $local['id_local'] }}">{{ $local['ciudad'] }}</option>
                    @endif
                @endforeach
            </select></p>
            <button class="btn btn-primary " type="submit">Modificar</button>
        </form>
        <form action="{{ route('reserva.ver') }}">
            <button class="btn btn-primary " type="submit">Ver mis reservas</button>
        </form>
    </div>
</main>

@endsection