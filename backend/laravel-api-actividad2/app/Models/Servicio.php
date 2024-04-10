<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $primaryKey = 'codigo';
    
    use HasFactory;

    protected $fillable = [
        'descripcion',
        'nombre',
        'precio',
    ];


    public function empleados()
    {
        return $this->belongsToMany(Empleado::class, 'presta', 'codigo_servicio', 'id_empleado');
    }

    public function citas()
    {
        return $this->belongsToMany(Cita::class, 'ofrece', 'codigo_servicio', 'id_cita');
    }
}
