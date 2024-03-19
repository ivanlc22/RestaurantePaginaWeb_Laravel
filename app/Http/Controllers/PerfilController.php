<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PerfilRequest;
use App\Models\User;
use App\Models\Cliente;
use Illuminate\Support\Facades\Validator;

class PerfilController extends Controller
{
    public function verPerfil()
    {
        return view('auth.perfil');
    }

    public function verModificarPerfil()
    {
        return view('auth.modificar-perfil');
    }

    public function modificar(PerfilRequest $request){

        $user = User::find(Auth::user()->id);
        $cliente = Cliente::where('id_usuario', Auth::user()->id)->first();
        if($request->name != null) { $user->name = $request->name; }
        if($request->email != null) { $user->email = $request->email; }
        if($request->telefono != null) { $cliente->telefono = $request->telefono; }
        if($request->direccion != null) { $cliente->direccion = $request->direccion; }
        $user->update();
        $cliente->update();

        return redirect('/perfil');
    }


    public function obtenerPedidoProductos(){

        $user = auth()->user();
        $pedidos = $user->pedido;
        return view('auth.historial-pedidos', ['pedidos' => $pedidos]);
    }


}
