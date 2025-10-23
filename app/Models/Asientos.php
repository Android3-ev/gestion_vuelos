<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asientos extends Model
{
    use HasFactory;

    protected $table = 'asientos';

    protected $fillable = [
        'asiento',
        'estado'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    // RELACION DE ASIENTOS CON RESERVAS
    public function reserva()
    {
        return $this->hasMany(Reserva::class);
    }
}
