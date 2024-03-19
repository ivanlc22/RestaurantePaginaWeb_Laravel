<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\Producto; 
use App\Models\Pedido;
use App\Models\User; 
use App\Models\RelCarProd;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $carrito = Carrito::all();
        return view('carrito', compact('carrito'));
    }

    public function mostrarProductos()
    {
        $carta = Producto::productos();
        return view('carrito.carrito', ['productos' => $carta]);
    }

    public function mostrarCarrito()
    {
        if(auth()->check()) // Si existe sesión iniciada, se muestra el carrito correspondiente. 
        {
            $usuario = auth()->user();
            $carrito = $usuario->carrito;

            $productos = $carrito->obtenerProductos();
            $precioTotal = $carrito->obtenerPrecioTotal();
            $carrito->actualizarPrecioTotal();
        }
        else
        {
            $productos = null;
            $precioTotal = 0; 
        }

        $categorias = ['menu', 'principal', 'entrante', 'bebida', 'postre'];
        $carta = Producto::productos();

        return view('carrito.carrito', ['productosCarrito' => $productos, 'productos' => $carta, 'precioCarrito' => $precioTotal, 'categorias' => $categorias]);
    }

    public function agregarProducto(Request $request)
    {
        if (!(auth()->check())) {
            return redirect('/carrito');
        }

        $usuario = auth()->user();
        $producto_id = $request->input('id_producto');

        $carrito = $usuario->carrito;

        $carrito->producto()->syncWithoutDetaching([
            $producto_id => ['cantidad' => DB::raw('cantidad + 1')]
        ]);

        return redirect('/carrito');
    }

    public function quitarProducto(Request $request)
    {
        if (!(auth()->check())) {
            return redirect('/carrito');
        }
        
        $usuario = auth()->user();
        $producto_id = $request->input('id_producto');

        $carrito = $usuario->carrito;

        $productoPivot = $carrito->producto()->wherePivot('id_producto', $producto_id)->first()->pivot;

        if ($productoPivot->cantidad == 1) 
        {
            $carrito->producto()->detach($producto_id);
        } 
        else 
        {
            $carrito->producto()->syncWithoutDetaching([
                $producto_id => ['cantidad' => DB::raw('cantidad - 1')]
            ]);
        }

        return redirect('/carrito');
    }

    public function menuCompra()
    {
        // Obtener productos del carrito, dirección usuario

        if(auth()->check()) // Si existe sesión iniciada, se muestra el carrito correspondiente. 
        {
            $usuario = auth()->user();
            $cliente = $usuario->cliente; 
            $carrito = $usuario->carrito;
            $direccion = $cliente->direccion; 

            $productos = $carrito->obtenerProductos();
            $precioTotal = $carrito->obtenerPrecioTotal();

            if ($carrito->producto->isEmpty()) 
            {
                return redirect('/carrito')->with('message', 'Debes agregar al menos un producto al carrito.');
            }
        }
        else
        {
            $direccionPredeterminada = null;
            $productos = null;
            $precioTotal = 0; 
        }

        return view('carrito.compra', ['productosCarrito' => $productos, 'direccion' => $direccion, 'precio' => $precioTotal]);
    }

    public function realizarCompra(Request $request)
    {
        // Obtener los campos enviados en la solicitud
        $usuario = auth()->user();
        $id_usuario = $usuario->id; 
        $carrito = $usuario->carrito;
        $productos = $carrito->obtenerProductos();
        $direccion = $request->input('direccion');

        if ($carrito->producto->isEmpty()) {
            return redirect('/carrito')->with('message', 'Debes agregar al menos un producto al carrito.');
        }

        // Crear un nuevo pedido
        $pedido = new Pedido([
            'id_pedido' => substr(uniqid(), 0, 8),
            'total_precio' => $carrito->obtenerPrecioTotal(),
            'id_usuario' => $id_usuario,
        ]);

        $pedido_id = $pedido->id_pedido; 
        
        $pedido->save(); 

        $pedidoBusqueda = Pedido::find($pedido_id);

        // Agregar productos al pedido
        foreach ($productos as $producto) {
            $cantidad = $producto->pivot->cantidad;
            $pedidoBusqueda->producto()->attach($producto->id_producto, ['cantidad' => $cantidad]);
        }

        // Actualizar el precio total del pedido
        $carrito->producto()->detach();

        return view('carrito.pedidoRealizado', ['direccion' => $direccion]);
    }
}
