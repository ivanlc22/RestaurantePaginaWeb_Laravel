<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $table = 'pedido';
    public $timestamps = false;
    protected $primaryKey = 'id_pedido';
    protected $keyType = 'string';
    protected $fillable = [
        'id_pedido',
        'total_precio',
        'id_usuario',
    ];

    public function producto()
    {
        return $this->belongsToMany(Producto::class, 'rel_ped_prod', 'id_pedido', 'id_producto')
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
}
