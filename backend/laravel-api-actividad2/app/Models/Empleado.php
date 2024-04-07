<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

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
        'salario',
        'fecha_contratacion',
        'numero_seguridad_social',
        'id_tienda',
    ];

    public function tienda()
    {
        return $this->belongsTo(Tienda::class, 'id_tienda');
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'presta', 'id_empleado', 'codigo_servicio');
    }
    
}
