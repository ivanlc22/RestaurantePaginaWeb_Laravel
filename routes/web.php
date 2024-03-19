<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReservaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
 
Route::get('/admin', [AdminController::class, 'index']);

Route::post('/admin/añadirUsuario', [AdminController::class, 'añadirUsuario']);

Route::post('/admin/eliminarUsuario', [AdminController::class, 'eliminarUsuario']);

Route::post('/admin/eliminarPedido', [AdminController::class, 'eliminarPedido']);

Route::post('/admin/añadirProducto',  [AdminController::class, 'añadirProducto']);

Route::post('/admin/eliminarProducto',  [AdminController::class, 'eliminarProducto']);

Route::post('/admin/añadirLocal',  [AdminController::class, 'añadirLocal']);

Route::post('/admin/eliminarLocal',  [AdminController::class, 'eliminarLocal']);

Route::post('/admin/añadirReserva',  [AdminController::class, 'añadirReserva']);

Route::post('/admin/eliminarReserva',  [AdminController::class, 'eliminarReserva']);




Route::get('/', function () {
    return view('welcome');
})->name('inicio');


Route::get('/register', function () {
    return view('auth.register');
});


Route::post('/register', [RegisterController::class, 'register']);

Route::get('/cerrar-sesion', [LoginController::class, 'cerrarSesion']);

Route::get('/carrito', [CartController::class, 'mostrarCarrito']);

Route::post('/carrito/agregar-producto', [CartController::class, 'agregarProducto']);

Route::post('/carrito/quitar-producto', [CartController::class, 'quitarProducto']);

Route::get("/perfil", [PerfilController::class, 'verPerfil'])->middleware('auth');;

Route::get("/modificar-perfil", [PerfilController::class, 'verModificarPerfil'])->middleware('auth');;

Route::post("/modificar-perfil", [PerfilController::class, "modificar"])->name("modificar");

Route::get('/carrito/comprar', [CartController::class, 'menuCompra'])->middleware('auth');; 

Route::post('/carrito/realizarCompra', [CartController::class, 'realizarCompra'])->middleware('auth');;

Route::get('/perfil/historial-pedidos', [PerfilController::class, 'obtenerPedidoProductos'])->middleware('auth');;

Route::get('/reservas', [ReservaController::class, 'index'])->middleware('auth');

Route::post('/reservas', 'App\Http\Controllers\ReservaController@agregarReserva')->name('reserva.crear');

Route::get('/reservas/ver', 'App\Http\Controllers\ReservaController@verReserva')->name('reserva.ver')->middleware('auth');;

Route::post('/reservas/ver', 'App\Http\Controllers\ReservaController@eliminarReserva')->name('reserva.eliminar');

Route::get('/reservas/modificar', 'App\Http\Controllers\ReservaController@modificar')->name('reserva.mod')->middleware('auth');;

Route::post('/reservas/modificar', 'App\Http\Controllers\ReservaController@modificarReserva')->name('reserva.modificar');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    
});
