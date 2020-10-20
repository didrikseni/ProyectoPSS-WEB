<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carreras extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'anio_inicio',
        'id_str',
        'departamento_responsable',
        'profesor_responsable',      
    ];

}