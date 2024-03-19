<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link rel="stylesheet" href="{{ asset('css/header.css') }}">
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<head>
    <meta charset="UTF-8">
    <title>La Puchería</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="navbar-brand">
                <a href="/">
                    <img id="logo-header" src="/img/logo.png" alt="La Pucheria Logo">
                </a>
            </div>
            
            @if (Auth::check() && Auth::user()->cliente)

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="funciones"><a href="/reservas">Reservas</a></div>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="funciones"><a href="/carrito">Nuestra carta</a></div>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="perfil"><a href="/perfil">{{Auth::user()->name}}</a></div>
                    </li>
                </ul>    
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="cerrar"><a href="/cerrar-sesion">Cerrar sesión</a></div>
                    </li>    
                </ul>

            @elseif (Auth::check() && Auth::user()->admin)
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="funciones"><a href="/admin">CRUD</a></div>
                    </li>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="cerrar"><a href="/cerrar-sesion">Cerrar sesión</a></div>
                    </li>    
            @else
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="funciones"><a href="/login">Reservar</a></div>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="funciones"><a href="/carrito">Nuestra carta</a></div>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="perfil"><a href="/login">Iniciar Sesión</a></div>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="perfil"><a href="/register">Registrarse</a></div>
                    </li>
            @endif
            </ul>
        </nav>
    </header>

@yield('contenido')

<footer>
        <ul id="footer-funciones">
            <li><a href="#">FAQ</a></li>
            <li><a href="#">Términos y condiciones</a></li>
            <li><a href="#">Conoce a nuestro equipo</a></li>
            <li><a href="#">Últimas novedades</a></li>
        </ul>

        <ul id="footer-redes">
            <li><a href="#" id="instagram" class="fa fa-instagram" aria-hidden="true"></a></li>
            <li><a href="#" id="facebook" class="fa fa-facebook" aria-hidden="true"></a></li>
            <li><a href="#" id="twitter" class="fa fa-twitter" aria-hidden="true"></a></li>
        </ul>
        
</footer>
</body>
</head>