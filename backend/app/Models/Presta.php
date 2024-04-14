<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presta extends Model
{
    use HasFactory;

    protected $table = 'presta';
    protected $primaryKey = ['codigo_servicio', 'id_empleado'];
    public $incrementing = false;
    
    protected $fillable = ['codigo_servicio', 'id_empleado'];
}
