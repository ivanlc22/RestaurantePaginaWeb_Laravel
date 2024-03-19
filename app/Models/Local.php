<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Local extends Model
{
    use HasFactory;

    protected $table = 'local';
    protected $primaryKey = 'id_local';
    public $timestamps = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id_local',
        'ciudad',
        'direccion',
    ];

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    public static function locales()
    {
        return Local::all();
    }

    public static function getLocalbyId($id)
    {
        $local = Local::where('id_local', $id)->first();
        return $local;
    }
}
