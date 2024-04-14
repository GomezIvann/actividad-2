<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ofrece extends Model
{
    use HasFactory;

    protected $table = 'ofrece'; 

    protected $primaryKey = null;

    public $incrementing = false; 

    protected $fillable = ['codigo_servicio', 'id_cita']; 
}