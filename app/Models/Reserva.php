<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reservas';

    protected $fillable = [
        'user_id',
        'vuelo_id',
        'asiento_id',
        'nombre_completo',
        'tipo_documento',
        'documento',
        'correo',
        'celular',
    ];
}
