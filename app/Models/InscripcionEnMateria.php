<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InscripcionEnMateria extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_alumno',
        'id_materia'
    ];
}
