@extends('layouts.header')
@section('contenido')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
    <title>Registro</title>
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
    <form action="/register" method="POST" class="form-login">
    @csrf
    <label for="login-input-user" class="login__label">
			Nombre de usuario
		</label> <input type="text" name="name" class="login__input" required>
    <label for="login-input-user" class="login__label">
			Correo electrónico
		</label> <input type="email" name="email" class="login__input" required>
    <label for="login-input-user" class="login__label">
			Contraseña
		</label> <input type="password" name="password" class="login__input" required>
    <label for="login-input-user" class="login__label">
			Confirmar contraseña
		</label> <input type="password" name="password_confirmation" class="login__input" required>
    <label for="login-input-user" class="login__label">
			Teléfono
		</label> <input type="number" name="telefono" class="login__input" required>
    <label for="login-input-user" class="login__label">
			Dirección
		</label> <input type="text" name="direccion" class="login__input" required>
    <br><br><br><br>
    <input type="submit" class="login__submit" value="Registrarse"></input>
	</form>
</div>
</body>
</html>
@endsection