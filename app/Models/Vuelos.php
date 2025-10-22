<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vuelos extends Model
{
    use HasFactory;

    protected $table = 'vuelos';

    protected $fillable = [
        'avion_id',
        'image',
        'origen',
        'destino',
        'fecha_salida',
        'fecha_llegada',
        'tipo_vuelo',
        'precio'
    ];

    public function avions()
    {
        return $this->belongsTo(Avion::class);
    }

}
