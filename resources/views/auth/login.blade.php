@extends('layouts.header')
@section('contenido')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
    <title>Iniciar sesión</title>
</head>

        @if ($errors->any())
        <div class="errores">
            <ul> 
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
        @endif

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <div class = "login-container">
        <form method="POST" action="{{ route('login') }}" class="form-login">
            @csrf

            <label for="login-input-user" class="login__label">
			Email
		    </label>
                <x-input id="email" class="login__input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />

            <label for="login-input-user" class="login__label">
			Contraseña
		    </label>
                <x-input id="password" class="login__input" type="password" name="password" required autocomplete="current-password" />
                <br><br><br><br>
                <input type="submit" class="login__submit" value="Iniciar sesión"></input>
                <div class="ya-registrado"><a href="/register">¿No estás registrado?</a></div>
            </div>
        </form>

        @if (session('exito'))
        <div class="exito-registro">{{ session('exito') }}</div>
    @endif

</div>

@endsection
