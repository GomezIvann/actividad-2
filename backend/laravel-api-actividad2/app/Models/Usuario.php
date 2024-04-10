<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $primaryKey = 'dni';

    protected $table = 'usuario';

    protected $fillable = [
        'nombre_usuario',
        'nombre_completo',
        'genero',
        'direccion',
        'ciudad',
        'pais',
        'correo',
        'contraseña',
        'telefono',
    ];
}
