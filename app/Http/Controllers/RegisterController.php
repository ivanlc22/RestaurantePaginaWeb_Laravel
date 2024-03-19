<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Carrito;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
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

        return redirect('login')->with('exito', 'Registro realizado satisfactoriamente');
    }
}
