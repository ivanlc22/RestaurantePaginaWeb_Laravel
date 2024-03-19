@extends('layouts.header')
@section('contenido')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
    <title>Modificar perfil</title>
</head>
<body>

@if ($errors->any())
        <div class="errores">
            <ul> 
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
        @endif

    <div class="login-container">
    <form action="/modificar-perfil" method="POST" class="form-login">
    @csrf
    <label for="login-input-user" class="login__label">
			Nombre de usuario
		</label> <input type="text" name="name" class="login__input" value="{{Auth::user()->name}}">
    <label for="login-input-user" class="login__label">
			Correo electrónico
		</label> <input type="email" name="email" class="login__input" value="{{Auth::user()->email}}">
    <label for="login-input-user" class="login__label">
			Teléfono
		</label> <input type="number" name="telefono" class="login__input" value="{{Auth::user()->cliente->telefono}}">
    <label for="login-input-user" class="login__label">
			Dirección
		</label> <input type="text" name="direccion" class="login__input" value="{{Auth::user()->cliente->direccion}}">
    <br><br><br><br>
    <input type="submit" class="login__submit" value="Modificar perfil"></input>
    </form>
    </div>

    
</body>
</html>
@endsection