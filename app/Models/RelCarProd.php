<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RelCarProd extends Model
{
    use HasFactory;

    protected $table = 'rel_car_prod';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['id_carrito','id_producto','cantidad'];
    protected $primaryKey = null;

    public function producto() 
    {
        return $this->belongsToMany(Producto::class, 'id_producto');
    }

    public function carrito() 
    {
        return $this->belongsToMany(Carrito::class, 'id_carrito');
    }
}