<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleado'; 

    protected $fillable = [
        'nombre',
        'apellidos',
        'ciudad',
        'pais',
        'imagen',
        'red_social',
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
