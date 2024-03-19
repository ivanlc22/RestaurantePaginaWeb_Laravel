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

<body>
  <h1>¡Haz tu reserva!</h1>
  <div class="cuadrado">
    <form method="POST" action="{{ route('reserva.crear') }}">
      @csrf
      <p> Fecha: <input
        type="date"
        name="fecha"
        class="form-control mb-2"
        value="{{ old('fecha') }}"
      /></p>
      <p> Hora: <input
        type="time"
        name="hora"
        class="form-control mb-2"
        min ="12:00" 
        max ="23:00"
      /></p>
      <p>Número de personas: <input
        type="number"
        name="num_personas"
        class="form-control mb-2"
        value="{{ old('num_personas') }}"
      /></p>
      <p>Local: <select name="id_local" id="id_local" >
        <option selected disabled readonly>Elige local</option>
        @foreach($locales as $local)
          <option value="{{ $local['id_local'] }}">{{ $local['ciudad'] }}</option>
        @endforeach
      </select></p>
      <button class="btn" type="submit">Reservar</button>
    </form>
    <br>
    <br>
    <br>
    <br>
    <a>¿Ya tienes hecha una reserva?</a>
    <a href="{{ route('reserva.ver') }}" style="color:darkgreen">Ver mi reserva</a>
  </div>
</body>

@endsection