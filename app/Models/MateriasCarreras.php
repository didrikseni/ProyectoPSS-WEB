<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriasCarreras extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_materia',
        'id_carrera',
        'cuatrimestre',
        'anio'
    ];


    public function materias()
    {
        return $this->belongsTo(Carrera::class);
    }

    public function carrera()
    {
        $this->belongsTo(Materia::class);
    }
}
