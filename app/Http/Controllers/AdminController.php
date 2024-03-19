<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Carrito;
use App\Models\Producto;
use App\Models\Local;
use App\Models\Reserva;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()     //el metodo index devuelve todas las listas
    {
        $users = User::all();
        $carritos = Carrito::all();
        $productos = Producto::all();
        $locales = Local::all();
        $reservas = Reserva::all();
        
        return view('admin.admin', compact('users', 'carritos', 'productos', 'locales', 'reservas'));
        //return view('admin.admin',compact('users'),  compact('carritos'),   compact('productos'),  compact('locales'),   compact('reservas'));
    }


    public function añadirUsuario(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|string|max:255|unique:users,email',
            'password' => 'required|string|max:255|',
            'direccion' => 'required|string|max:255|',
            'telefono' => 'required|numeric|max:9999999999|unique:cliente,telefono'
        ]);
            
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' =>$request->password_confirmation
        ]);

        $cliente = Cliente::create([
            'id_usuario' => $user->id,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion
        ]);

        $carrito = Carrito::create([

            'id_carrito' => substr(uniqid(), 0, 8),
            'total_precio' => 0,
            'id_usuario' => $user->id
        ]);
        return redirect('/admin')->with('message1', 'Usuario añadido exitosamente.');
    }


    public function eliminarUsuario(Request $request)
    { 
        $id = $request->input('id');
        $user = User::find($id);

        if (!$user){
            return redirect('/admin')->with('message2', 'El id no pertenece a ningun usuario.'); 
        }
            $user->forceDelete();
            return redirect('/admin')->with('message3', 'Usuario eliminado exitosamente.');   
    }


    public function eliminarPedido(Request $request)
    { 
        $id_carrito = $request->input('id2');
        $carrito = Carrito::find($id_carrito);

        if (!$carrito){
            return redirect('/admin')->with('message4', 'El id no pertenece a ningun pedido.'); 
        }
            $carrito->forceDelete();
            return redirect('/admin')->with('message5', 'Pedido eliminado exitosamente.');    
    }


    public function eliminarProducto(Request $request)
    { 
        $id_producto = $request->input('id3');
        $producto = Producto::find($id_producto);

        if (!$producto){
            return redirect('/admin')->with('message6', 'El id no pertenece a ningun producto.'); 
        }
            $producto->forceDelete();
            return redirect('/admin')->with('message7', 'Producto eliminado exitosamente.');
    }


    public function añadirProducto(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255|unique:producto,nombre',
            'precio' => 'required|numeric',
            'tipo' => 'required|string|min:6',
            'descripcion' => 'required|string|max:255',
        ]);

        $producto = new Producto();
        $producto->id_producto = substr(uniqid(), 0, 8);
        $producto->nombre = $validatedData['nombre'];
        $producto->precio = $validatedData['precio'];
        $producto->tipo = $validatedData['tipo'];
        $producto->descripcion = $validatedData['descripcion'];
        $producto->save();

        return redirect('/admin')->with('message8', 'Producto añadido exitosamente.');
    }


    public function eliminarLocal(Request $request)
    { 
        $id_local = $request->input('id4');
        $local = Local::find($id_local);

        if (!$local){
            return redirect('/admin')->with('message9', 'El id no pertenece a ningun local.'); 
        }
            $local->forceDelete();
            return redirect('/admin')->with('message10', 'Local eliminado exitosamente.');
    }


    public function añadirLocal(Request $request)
    {
        $validatedData = $request->validate([
            'ciudad' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
        ]);

        $local = new Local();
        $local->id_local = substr(uniqid(), 0, 8);
        $local->ciudad = $validatedData['ciudad'];
        $local->direccion = $validatedData['direccion'];
        $local->save();

        return redirect('/admin')->with('message11', 'Local añadido exitosamente.');
    }


    public function eliminarReserva(Request $request)
    { 
        $id_reserva = $request->input('id5');
        $reserva = Reserva::find($id_reserva);

        if (!$reserva){
            return redirect('/admin')->with('message12', 'El id no pertenece a ninguna reserva.'); 
        }
            $reserva->forceDelete();
            return redirect('/admin')->with('message13', 'Reserva eliminada exitosamente.');
    }


    public function añadirReserva(Request $request)
    {
        $validatedData = $request->validate([
            'fecha' => 'required|after:today',
            'hora' => 'required',
            'num_personas' => 'required|integer|min:1|max:20',
            'id_local' => 'required',
            'id_usuario' => 'required|exists:users,id',
            'id_local' => 'required|exists:local,id_local'
        ]);
        
        $reserva = new Reserva();
        $reserva->id_reserva = substr(uniqid(), 0, 8);
        $reserva->num_personas = $validatedData['num_personas'];
        $reserva->fecha = $validatedData['fecha'];
        $reserva->hora = $validatedData['hora'];
        $reserva->id_usuario = $validatedData['id_usuario'];
        $reserva->id_local = $validatedData['id_local'];
        
        $reserva->save();
        return redirect('/admin')->with('message14', 'Reserva añadida exitosamente.');
    }

}
