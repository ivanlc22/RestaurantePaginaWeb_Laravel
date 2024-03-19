<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReservaRequest;
use App\Models\Reserva;
use App\Models\User;
use App\Models\Local;

class ReservaController extends Controller
{
    public function index()
    {
        $locales = Local::locales();

        return view('reservas.reservas', compact('locales'));
    }

    public function agregarReserva(ReservaRequest $request)
    {

        if(!auth()->user()->reserva)
        {
            $reserva = new Reserva;
            $reserva->id_reserva = substr(uniqid(), 0, 8);
            $reserva->num_personas = $request->num_personas;
            $reserva->fecha = $request->fecha;
            $reserva->hora = $request->hora;
            $reserva->id_usuario = auth()->user()->id;
            $reserva->id_local = $request->id_local;
            $reserva->save();

            return back()->with('mensaje', 'Reserva agregada');
        }
        else
        {
            return back()->with('mensaje', 'Solo se permite una reserva por usuario');
        }
    }

    public function verReserva()
    {
        $usuario = auth()->user();
        $reserva = $usuario->reserva;
        if($reserva)
            $local = Local::getLocalbyId($reserva->id_local);
        else
            $local = "";
        return view('reservas.mireserva', compact('reserva', 'local'));
    }

    public function eliminarReserva()
    {
        $usuario = auth()->user();
        $reserva = $usuario->reserva;
        $reserva->delete();

        return back()->with('mensaje', 'Reserva eliminada');
    }

    public function modificar()
    {
        $usuario = auth()->user();
        $reserva = $usuario->reserva;
        $local_actual = Local::getLocalbyId($reserva->id_local);
        $locales = Local::locales();
        return view('reservas.modreserva', compact('reserva', 'local_actual', 'locales'));
    }

    public function modificarReserva(ReservaRequest $request)
    {
        $usuario = auth()->user();
        $reserva = $usuario->reserva;
        $reserva->num_personas = $request->num_personas;
        $reserva->fecha = $request->fecha;
        $reserva->hora = $request->hora;
        $reserva->id_local = $request->id_local;
        $reserva->update();

        return back()->with('mensaje', 'Reserva modificada');
    }
}
