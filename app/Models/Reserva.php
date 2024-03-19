<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reserva';
    protected $primaryKey = 'id_reserva';
    public $timestamps = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id_reserva',
        'num_personas',
        'fecha',
        'hora',
        'id_usuario',
        'id_local',
    ];

    
    public function obtenerReserva()
    {
        return User::find(1)->reserva;
    }

    public function local()
    {
        return $this->belongsTo(Local::class);
    }

}
