<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link rel="stylesheet" href="{{ asset('css/carta.css') }}">
<head>
<meta charset="UTF-8">

@extends('layouts.header')
@section('contenido')

<!-- Menú para categoría -->
<div class="contenedor">
    <div id="categoria">
            <div class="sidebar">
                <ul>
                    <li><a href="#" data-categoria="">Todos los productos</a></li>
                    @foreach($categorias as $categoria)
                    <li><a href="#" data-categoria="{{ $categoria }}">{{ $categoria }}</a></li>
                    @endforeach
                </ul>
            </div>
    </div>

    <!-- Listado de productos -->
    <div class="productos">
                @foreach($productos as $producto)
                <div class="producto {{ $producto->tipo }}">
                <div class="item">
                @if (count(glob(public_path("img/{$producto->nombre}.jpg"))) > 0)
                    <img src="/img/{{ $producto->nombre }}.jpg">
                @else
                    <img src="/img/placeholder.png">
                @endif
                <div class="details">
                        <h5>{{ $producto->nombre }}</h5>
                        <h5 class="price">{{ $producto->precio }}$</h5>
                </div>
                @if(Auth::check())
                    <form method="POST" action="/carrito/agregar-producto">
                        @csrf
                        <input type="hidden" name="id_producto" value="{{ $producto->id_producto }}">
                        <button type="submit" class="specialbutton">Añadir al carrito</button>
                    </form>
                @endif
                </div>
                </div>
                @endforeach     
    </div>

    <!-- JavaScript para menú categoría -->
    <script>
        document.querySelectorAll('.sidebar a').forEach(function(enlace) {
            enlace.addEventListener('click', function(evento) {
                evento.preventDefault();
                var categoria = this.getAttribute('data-categoria');
                filtrarProductos(categoria);
            });
        });

        function filtrarProductos(categoria) {
            var productos = document.getElementsByClassName('producto');
            for (var i = 0; i < productos.length; i++) {
                if (categoria === '' || productos[i].classList.contains(categoria)) {
                productos[i].style.display = 'block';
                } else {
                productos[i].style.display = 'none';
                }
            }
        }
        var sidebar = document.querySelector('.sidebar');
        sidebar.style.display = 'block'; // mostrar la barra lateral
        filtrarProductos(''); // mostrar todos los productos por defecto
    </script>


    <!-- carrito -->
    <br>
        <div class="carrito">
            <div class="header-carrito"><h1>Tu carrito</h1></div>
                @if (Auth::check())
                    @foreach($productosCarrito as $productoCarrito)
                        <div class="carrito-producto">
                        <div class="inline"><p>{{ $productoCarrito->nombre }}</p></div>
                            <div id="btn-mas">
                            <form method="POST" action="/carrito/agregar-producto">
                            @csrf
                            <input type="hidden" name="id_producto" value="{{ $productoCarrito->id_producto }}">
                            <button class="icon-btn add-btn" type="submit">
                                <div class="add-icon"></div>
                                <div class="btn-txt">Add</div>
                            </button>
                            </form>
                        </div>
                        <div id="cantidad"> {{ $productoCarrito->pivot->cantidad }} </div>
                        <div id="btn-menos">
                            <form method="POST" action="/carrito/quitar-producto">
                            @csrf
                            <input type="hidden" name="id_producto" value="{{ $productoCarrito->id_producto }}">
                            <button class="icon-btn add-btn" type="submit">
                                <div class="btn-txt">Remove</div>
                            </button>
                            </form>
                        </div>
                        <div class="carrito-precio-producto"><p>${{ $productoCarrito->precio * $productoCarrito->pivot->cantidad }}</p></div>
                        </div>
                        <br>
                    @endforeach
                    <hr>
                    <div class="carrito-precio-producto"><h3>Precio total: ${{ $precioCarrito }}</h3></div>
                    <!-- Añadir botón de compra -->
                    <button class="button buybutton" onclick="window.location.href='/carrito/comprar'">
                        <i class="fa fa-shopping-cart"></i>
                        <span>Comprar</span>
                    </button>
                    <br><br>
                    @if (session('message'))
                        <div class="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                @else
                    <p> Por favor, inicie sesión o registrese para poder realizar pedidos. <p>
                @endif
        </div>
</div>
@endsection
</head>
<body>
</body>
</html>   