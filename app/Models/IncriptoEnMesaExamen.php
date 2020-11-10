<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncriptoEnMesaExamen extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_alumno',
        'id_mesa_examen'
    ];
}
