<!DOCTYPE html>
<body>
<head>
<meta charset="UTF-8">

@extends('layouts.header')
@section('contenido')
        
<!-- -------------------------------------------------------------------------------------- -->

    <!-- Listado de usuarios -->
    <h1>Listado de Usuarios</h1>
    <br>
        <div id="usuarios">
            @foreach($users as $user)
              @if ($user->cliente)
                    <h3><strong>Nombre:</strong> {{ $user->name }}</h3>
                    <p><strong>ID:</strong> {{ $user->id }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Contraseña:</strong> {{ $user->password }}</p>
                    <p><strong>Teléfono:</strong> {{ $user->cliente->telefono }}</p>
                    <p><strong>Dirección:</strong> {{ $user->cliente->direccion }}</p>
                    <br>
              @endif
            @endforeach
        </div>

    <!-- Añadir usuarios -->
      <h1>Añadir Usuario</h1>
      <br>
 <form action="/admin/añadirUsuario" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="form-group">
        <label for="telefono">Teléfono</label>
        <input type="number" class="form-control" id="telefono" name="telefono" required>
    </div>
    <div class="form-group">
        <label for="direccion">Dirección</label>
        <input type="direccion" class="form-control" id="direccion" name="direccion" required>
    </div>
    <button type="submit" class="btn btn-primary">Añadir Usuario</button>
    
 </form>
 <br>
  @if (session('message1'))
    <div class="alert alert-success">{{ session('message1') }}</div>
  @endif


    <!--   Eliminar usuarios  -->
    <h1>Eliminar Usuario</h1>
    <br>

    <form action="/admin/eliminarUsuario" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="POST">
                            <div class="form-group">
                                <input type="number" name="id" class="form-control" placeholder="ID de usuario">
                            </div>
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                        <br>


  @if (session('message2'))
    <div class="alert alert-success">{{ session('message2') }}</div>
  @endif

  @if (session('message3'))
    <div class="alert alert-success">{{ session('message3') }}</div>
  @endif
                        
<!-- -------------------------------------------------------------------------------------- -->

    <!-- Listado de pedidos -->
    <h1>Listado de pedidos</h1>
    <br>
        <div id="pedidos">
            @foreach($carritos as $carrito)
                    <p><strong>ID:</strong> {{ $carrito->id_carrito }}</p>
                    <p><strong>Precio total:</strong> {{ $carrito->total_precio }}</p>
                    <p><strong>ID Usuario:</strong> {{ $carrito->id_usuario }}</p>
                    <br>
            @endforeach
        </div>


    <!--   Eliminar pedido  -->
    <h1>Eliminar Pedido</h1>
    <br>
    <form action="/admin/eliminarPedido" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="POST">
                            <div class="form-group">
                                <input type="text" name="id2" class="form-control" placeholder="ID de pedido">
                            </div>
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                        <br>


  @if (session('message4'))
    <div class="alert alert-success">{{ session('message4') }}</div>
  @endif

  @if (session('message5'))
    <div class="alert alert-success">{{ session('message5') }}</div>
  @endif


<!-- -------------------------------------------------------------------------------------- -->


   <!-- Listado de productos -->
   <h1>Listado de productos</h1>
   <br>
        <div id="productos">
            @foreach($productos as $producto)
                    <p><strong>ID:</strong> {{ $producto->id_producto }}</p>
                    <p><strong>Nombre:</strong> {{ $producto->nombre }}</p>
                    <p><strong>Precio:</strong> {{ $producto->precio }}</p>
                    <p><strong>Tipo:</strong> {{ $producto->tipo }}</p>
                    <p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
                    <br>
            @endforeach
        </div>

    <!--   Eliminar producto  -->
    <h1>Eliminar Producto</h1>
    <br>
    <form action="/admin/eliminarProducto" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="POST">
                            <div class="form-group">
                                <input type="text" name="id3" class="form-control" placeholder="ID de producto">
                            </div>
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                        <br>

  @if (session('message6'))
    <div class="alert alert-success">{{ session('message6') }}</div>
  @endif

  @if (session('message7'))
    <div class="alert alert-success">{{ session('message7') }}</div>
  @endif


        
    <!-- Añadir producto -->
    <h1>Añadir producto</h1>
    <br>
<form action="/admin/añadirProducto" method="POST">
   @csrf
   <div class="form-group">
       <label for="nombre">Nombre</label>
       <input type="text" class="form-control" id="nombre" name="nombre" required>
   </div>
   <div class="form-group">
       <label for="precio">Precio</label>
       <input type="number" class="form-control" id="precio" name="precio" required>
   </div>
   <div class="form-group">
       <label for="tipo">Tipo</label>
       <select name="tipo" id="tipo">
         <option value="menu">Menu</option>
         <option value="principal">Principal</option>
         <option value="entrante">Entrante</option>
         <option value="bebida">Bebida</option>
         <option value="postre">Postre</option>
       </select><br>
   </div>
   <div class="form-group">
       <label for="descripcion">Descripcion</label>
       <input type="text" class="form-control" id="descripcion" name="descripcion" required>
   </div>
   <button type="submit" class="btn btn-primary">Añadir Pedido</button>
   
</form>
<br>

 @if (session('message8'))
   <div class="alert alert-success">{{ session('message8') }}</div>
 @endif


<!-- -------------------------------------------------------------------------------------- -->


   <!-- Listado de locales -->
   <h1>Listado de locales</h1>
   <br>
        <div id="locales">
            @foreach($locales as $local)
                    <p><strong>ID:</strong> {{ $local->id_local }}</p>
                    <p><strong>Ciudad:</strong> {{ $local->ciudad }}</p>
                    <p><strong>Dirección:</strong> {{ $local->direccion }}</p>
                    <br>
            @endforeach
        </div>


    <!--   Eliminar local  -->
    <h1>Eliminar local</h1>
    <br>
    <form action="/admin/eliminarLocal" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="POST">
                            <div class="form-group">
                                <input type="text" name="id4" class="form-control" placeholder="ID de local">
                            </div>
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                        <br>

    
  @if (session('message9'))
    <div class="alert alert-success">{{ session('message9') }}</div>
  @endif

  @if (session('message10'))
    <div class="alert alert-success">{{ session('message10') }}</div>
  @endif                        
        
    <!-- Añadir local -->
    <h1>Añadir local</h1>
    <br>
<form action="/admin/añadirLocal" method="POST">
   @csrf
   <div class="form-group">
       <label for="ciudad">Ciudad</label>
       <input type="text" class="form-control" id="ciudad" name="ciudad" required>
   </div>
   <div class="form-group">
       <label for="direccion">Direccion</label>
       <input type="text" class="form-control" id="direccion" name="direccion" required>
   </div>
   <button type="submit" class="btn btn-primary">Añadir Local</button>
   
</form>
<br>
 @if (session('message11'))
   <div class="alert alert-success">{{ session('message11') }}</div>
 @endif


<!-- -------------------------------------------------------------------------------------- -->



   <!-- Listado de reservas -->
   <h1>Listado de reservas</h1>
   <br>
        <div id="reservas">
            @foreach($reservas as $reserva)
                    <p><strong>ID:</strong> {{ $reserva->id_reserva }}</p>
                    <p><strong>Núm. personas:</strong> {{ $reserva->num_personas }}</p>
                    <p><strong>Fecha:</strong> {{ $reserva->fecha }}</p>
                    <p><strong>Hora:</strong> {{ $reserva->hora }}</p>
                    <p><strong>ID Usuario:</strong> {{ $reserva->id_usuario }}</p>
                    <br>
            @endforeach
        </div>


    <!--   Eliminar reserva  -->
    <h1>Eliminar reserva</h1>
    <br>
    <form action="/admin/eliminarReserva" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="POST">
                            <div class="form-group">
                                <input type="text" name="id5" class="form-control" placeholder="ID de reserva">
                            </div>
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                        <br>

  @if (session('message12'))
    <div class="alert alert-success">{{ session('message12') }}</div>
  @endif

  @if (session('message13'))
    <div class="alert alert-success">{{ session('message13') }}</div>
  @endif
        
    <!-- Añadir reserva -->
    <h1>Añadir reserva</h1>
    <br>
<form action="/admin/añadirReserva" method="POST">
   @csrf
   <div class="form-group">
       <label for="num_personas">Numero de personas</label>
       <input type="text" class="form-control" id="num_personas" name="num_personas" required>
   </div>
   <div class="form-group">
       <label for="fecha">Fecha</label>
       <input type="date" class="form-control" id="fecha" name="fecha" required>
   </div>
   <div class="form-group">
       <label for="hora">Hora</label>
       <input type="time" class="form-control" id="hora" name="hora" required>
   </div>
   <div class="form-group">
       <label for="id_usuario">Id de usuario</label>
       <input type="text" class="form-control" id="id_usuario" name="id_usuario" required>
   </div>
   <div class="form-group">
       <label for="id_local">Id local</label>
       <input type="text" class="form-control" id="id_local" name="id_local" required>
   </div>
   <button type="submit" class="btn btn-primary">Añadir Reserva</button>
   
</form>
<br>

 @if (session('message14'))
   <div class="alert alert-success">{{ session('message14') }}</div>
 @endif

<!-- -------------------------------------------------------------------------------------- -->



@endsection
</head>
</body>
</html>   

