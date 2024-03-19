<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';
    public $timestamps = false;
    protected $primaryKey = 'id_producto';
    protected $keyType = 'string';
    protected $fillable = [
        'id_producto',
        'nombre',
        'precio',
        'tipo',
        'descripcion',
    ];

    public function carrito()
    {
        //return $this->hasMany(RelCarProd::class, 'id_producto');
        //return $this->belongsToMany(Carrito::class, 'rel_car_prod', 'id_producto', 'id_carrito')
        //            ->withPivot('cantidad');
        return $this->belongsToMany(Carrito::class, 'rel_car_prod', 'id_carrito', 'id_producto')
                    ->withPivot('cantidad');
    }

    public function pedido()
    {
        return $this->belongsToMany(Pedido::class, 'rel_ped_prod', 'id_pedido', 'id_producto')
                    ->withPivot('cantidad');
    }

    public static function productos()
    {
        return Producto::all();
    }
}
