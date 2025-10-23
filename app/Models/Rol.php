<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = "rols";

    protected $fillable = [
        "rol_name"
    ];

    protected $hidden = [
        "created_at",
        "updated_at",
    ];
    // RELACION DE ROLES CON USUARIOS
    public function users()
    {
        return $this->hasMany(User::class, "rol_id");
    }
}
