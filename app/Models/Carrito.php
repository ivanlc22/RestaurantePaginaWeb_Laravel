<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    protected $table = 'carrito';
    public $timestamps = false;
    protected $primaryKey = "id_carrito";
    protected $keyType = 'string';
    protected $fillable = [
        'id_carrito',
        'total_precio',
        'id_usuario',
    ];

    public function producto()
    {
        return $this->belongsToMany(Producto::class, 'rel_car_prod', 'id_carrito', 'id_producto')
                    ->withPivot('cantidad');
    }

    public function obtenerProductos()
    {
        return $this->producto()->get();
    }

    public function obtenerPrecioTotal()
    {
        $productos = $this->producto()->get();
        $precioTotal = 0;
        foreach($productos as $producto) 
        {
            $cantidad = $producto->pivot->cantidad;
            $precio = $producto->precio;
            $precioTotal += $cantidad * $precio;
        }
        return $precioTotal;
    }

    public function actualizarPrecioTotal()
    {
        $precioTotal = $this->obtenerPrecioTotal();
        $this->total_precio = $precioTotal;
        $this->save();
    }
}
