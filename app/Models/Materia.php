<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_str',
        'nombre',
        'departamento',
        'id_profesor',
        'id_asistente',
    ];

    public function profesor()
    {
        return $this->hasOne(User::class);
    }

    public function asistente()
    {
        return $this->hasOne(User::class);
    }

    public function getCorrelativasFuertes()
    {
        return Materia::join('materia_correlativa', 'materia_correlativa.id_materia', '=', 'materias.id')
            ->select('materia_correlativa.id_correlativa')
            ->where('materia_correlativa.tipo', '=', '1')->get();
    }

    public function getCorrelativasDebiles()
    {
        return Materia::join('materia_correlativa', 'materia_correlativa.id_materia', '=', 'materias.id')
            ->select('materia_correlativa.id_correlativa')
            ->where('materia_correlativa.tipo', '=', '0')->get();
    }


}
