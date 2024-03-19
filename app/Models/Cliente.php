<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'cliente';
    public $timestamps = false;
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'id_usuario',
        'telefono',
        'direccion',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
